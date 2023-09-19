<?php
namespace App\Repositry\Subjects;

use App\Interface\Subjects\SubjectsRepositoryInterface;

use App\Models\teachers;
use App\Models\Nationalitie;
use App\Models\genders;
use App\Models\Religion;
use App\Models\Type_Blood;
use App\Models\Grade;
use App\Models\my__parents;
use App\Models\sections;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;


class  SubjectsRepository   implements SubjectsRepositoryInterface
{
    public function index(){
        $subjects=Subject::all();
        return view('pages.Subjects.index',compact('subjects'));
    }

    public function show($id){
        //
    }

    public function edit($id){
        $subject=Subject::findOrFail($id);
        $grades=Grade::all();
        $teachers=teachers::all();

        return view('pages.Subjects.edit',compact('subject','grades','teachers'));
    }

    public function create(){
        $grades=Grade::all();
         $teachers=teachers::all();
         return view('pages.Subjects.create',compact('grades','teachers'));
    }

    public function store( $request){

        try{
           $subject=new Subject();
           $subject->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
           $subject->grade_id=$request->Grade_id;
           $subject->classroom_id=$request->Class_id;
           $subject->teacher_id=$request->teacher_id;
           $subject->save();
           session()->flash('add',trans('messages.success'));
                return  redirect()->route('subjects.index');
            }catch (\Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    public function update($request){

        try{
            $subject= Subject::findOrFail($request->id);
            $subject->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $subject->grade_id=$request->Grade_id;
            $subject->classroom_id=$request->Class_id;
            $subject->teacher_id=$request->teacher_id;
            $subject->save();
            session()->flash('edit',trans('messages.Update'));
                 return  redirect()->route('subjects.index');
             }catch (\Exception $e) {

                 return redirect()->back()->withErrors(['error' => $e->getMessage()]);
             }
    }

    public function destroy($request){

        try {
           Subject::destroy($request->id);
           session()->flash('delete',trans('messages.Delete'));

           return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
