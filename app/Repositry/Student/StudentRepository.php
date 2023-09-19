<?php

namespace  App\Repositry\Student;
use  App\Interface\Student\StudentRepositoryinterface;

use App\Models\teachers;
use App\Models\Nationalitie;
use App\Models\genders;
use App\Models\Religion;
use App\Models\Type_Blood;
use App\Models\Grade;
use App\Models\my__parents;
use App\Models\sections;
use App\Models\Student;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class StudentRepository implements StudentRepositoryinterface{
// get_student
public function get_student(){

$students=Student::all();
return view('pages.student.Allstudents',compact('students'));

}


public function createStudent(){
$data['genders']=genders::all();
$data['Nationalities']=Nationalitie::all();
//$data['Religion']=Religion::all();
$data['bloods']=Type_Blood::all();
$data['Grades']=Grade::all();
$data['parents']=my__parents::all();
return view('pages.student.add',$data);
}
// get all section for student function
public function getSections($id){
    $sections=sections::where('Class_id',$id)->pluck('Name_Section','id');
// dd($sections);
    return $sections;
}
// create student
public function insertStudent($request){
    DB::beginTransaction();

    try{

        $student=new Student();
        $student->name=['ar'=>$request->name_ar,'en'=>$request->name_en];
        $student->email=$request->email;
        $student->gender_id=$request->gender_id;
        $student->nationalitie_id=$request->nationalitie_id;
        $student->blood_id=$request->blood_id;
        $student->Date_Birth=$request->Date_Birth;
        $student->Grade_id=$request->Grade_id;
        $student->Classroom_id=$request->Classroom_id;
        $student->section_id=$request->section_id;
        $student->parent_id=$request->parent_id;
        $student->academic_year=$request->academic_year;
        $student->password= Hash::make($request->password);
        $student->save();
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $file){
                $name=$file->getClientOriginalName();
                 $file->storeAs('attachments/students/'.$student->id,$name,'upload_attachments');
                //  isert image to database
                $image=new Image;
                $image->filename=$name;
                $image->imageable_id=$student->id;
                $image->imageable_type='App\Models\Student';
                $image->save();


            }



            }
            DB::commit();
        session()->flash('add',trans('messages.success'));
        return redirect()->route('students.index');
    }  catch (Exception $e) {
        DB::rollback();

        return redirect()->back()->with(['error' => $e->getMessage()]);
    }


}
//go to edit page function
public function edit_student($id){
    $data['genders']=genders::all();
$data['Nationalities']=Nationalitie::all();
//$data['Religion']=Religion::all();
$data['bloods']=Type_Blood::all();
$data['Grades']=Grade::all();
$data['parents']=my__parents::all();
$student=student::findORfail($id);
return view('pages.student.editStudent',$data,compact('student'));

}

//go to update student function
public function update_student($request){
try{
    $id=$request->id;
$student=Student::findOrFail($id);
$student->name=['ar'=>$request->name_ar,'en'=>$request->name_en];
$student->email=$request->email;
$student->gender_id=$request->gender_id;
$student->nationalitie_id=$request->nationalitie_id;
$student->blood_id=$request->blood_id;
$student->Date_Birth=$request->Date_Birth;
$student->Grade_id=$request->Grade_id;
$student->Classroom_id=$request->Classroom_id;
$student->section_id=$request->section_id;
$student->parent_id=$request->parent_id;
$student->academic_year=$request->academic_year;
$student->password= Hash::make($request->password);
$student->save();


session()->flash('edit',trans('messages.Update'));
return redirect()->route('students.index');
}  catch (Exception $e) {
return redirect()->back()->with(['error' => $e->getMessage()]);
}

}
// delete a student function
public function delete_student($id){
    // Student::where('id',$id)->delete();
    Student::destroy($id); //can do multi delete fot multi ids
    session()->flash('delete',trans('messages.Delete'));
return redirect()->route('students.index');
}
// show_Student
public function show_Student($id){
    $Student=Student::findOrFail($id);
    return view('pages.student.show_student',compact('Student'));

}
// uplodeImage function
public function uplodeImage($request){
// dd($request);
$id=$request->student_id;
    if($request->hasfile('photos')){


 foreach($request->file('photos')as$file){

        $name=$file->getClientOriginalName();
        $file->storeAs('attachments/students/'.$id,$name,'upload_attachments');

    $image=new Image();
    $image->filename=$name;
    $image->imageable_id=$id;
    $image->imageable_type='App\Models\Student';
    $image->save();

     }
     session()->flash('add',trans('messages.success'));

     return redirect()->back();

}

}


// download atachment
public function download_img($student_id,$img_name){

     return response()->download(public_path('attachments/students/'.$student_id.'/'.$img_name));

}
// Delete_attachment
public function Delete_attachment ($request){
    storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_id.'/'.$request->img_name);
// delte from database
Image::where('id',$request->img_id)->where('filename',$request->img_name)->delete();
session()->flash('delete',trans('messages.Delete'));

return redirect()->back();
}
}
