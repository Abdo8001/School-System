<?php
namespace  App\Repositry\Student\StudentPromoted;

use App\Models\Grade;
use App\Models\promotions;
use App\Interface\Student\StudentPromoted\StudentPromotionRepositoryinterface;
use Illuminate\Support\Facades\DB;

use App\Models\Student;

class StudentPromotionRepository implements StudentPromotionRepositoryinterface {
// index function
public function index(){
    $Grades=Grade::all()  ;
   return view('pages.student.promotion.index',compact('Grades'));

}
// promote the student function

public function  store_New_promotion($request){
//dd($request);
DB::beginTransaction();

try{
    $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
    if($students->count()<1){
         return redirect()->back()->with(trans('messages.nomatch'));

    }
    foreach($students as $student){
        $ids=explode(',',$student->id);
        Student::whereIn('id',$ids)->update([
         'Grade_id'=>$request->Grade_id_new,
         'Classroom_id'=>$request->Classroom_id_new,
         'section_id'=>$request->section_id_new,
         'academic_year'=>$request->academic_year_new,

        ] );
// insert at promotions table
promotions::updateOrCreate([
    'student_id'=>$student->id,
    'from_grade'=>$request->Grade_id,
    'from_Classroom'=>$request->Classroom_id,
    'from_section'=>$request->section_id,
    'to_grade'=>$request->Grade_id_new,
    'to_section'=>$request->section_id_new,
    'to_Classroom'=>$request->Classroom_id_new,
    'academic_year'=>$request->academic_year,
    'academic_year_new'=>$request->academic_year_new,

]);
    }
    DB::commit();

    session()->flash('promotion',trans('messages.promotion'));
    return redirect()->route('promotion.create');
 }catch (\Exception $e) {

DB::rollback();
    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
}




}

// show promotion and mange it
public function showAll(){
    $promotions=promotions::all();
//     foreach($promotions as $promotion){

//     dd($promotion->from_grade->name);
// }
    return view('pages.student.promotion.promotion_mange',compact('promotions'));
}

// promotion delete function
public function DestroyAll($request){

try{

    if($request->page_id==1){
        $promotions=promotions::all();
        foreach($promotions as $promotion){
            $ids=explode(',',$promotion->student_id);
            Student::whereIn('id',$ids)->update([
             'Grade_id'=>$promotion->from_grade,
             'Classroom_id'=>$promotion->from_Classroom,
             'section_id'=>$promotion->from_section,
             'academic_year'=>$promotion->academic_year,

            ] );
            // delete all data at the table
            promotions::truncate();

        }

        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('students.index');

    }else{

        $promotion=promotions::findOrFail($request->promtion_id);
        Student::where('id',$promotion->student_id)->update([
            'Grade_id'=>$promotion->from_grade,
            'Classroom_id'=>$promotion->from_Classroom,
            'section_id'=>$promotion->from_section,
            'academic_year'=>$promotion->academic_year,

        ]);
        promotions::destroy($request->promtion_id);

        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('promotion.create');

    }

}catch (\Exception $e) {

        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


}

}
