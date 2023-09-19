<?php
namespace App\Repositry\Teacher;
use App\Interface\Teacher\TeacherRepositoryInterface;

use App\Models\teachers;
use App\Models\specializations;
use App\Models\genders;
use Illuminate\Support\Facades\Hash;


class TeacherRepository implements  TeacherRepositoryInterface {

    public function GetAllTeachers(){

        $teachers=teachers::all();
        return $teachers;

    }
     //    // gett all genders
     public function GetAllGenders(){
      $genders=genders::all();
      return $genders;
     }
     //    // gett all spicilizaion
     public function GetAllSpecilazation(){
        $specilization=specializations::all();
return $specilization;
     }
     public function Create_Teacher($request){
try{
// dd($request);
    $Teachers=new teachers();

    $Teachers->email= $request->Email;
    $Teachers->password =Hash::make($request->Password);
    $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
    $Teachers->Specialization_id = $request->Specialization_id;
    $Teachers->Gender_id = $request->Gender_id;
    $Teachers->Joining_Date = $request->Joining_Date;
    $Teachers->Address = $request->Address;
    $Teachers->save();
    session()->flash('add',trans('messages.success'));
    return redirect()->route('teachers.index');
}  catch (Exception $e) {
    return redirect()->back()->with(['error' => $e->getMessage()]);
}


     }
     public function FindById($id){
        return teachers::findOrFail($id);
     }
     public function updateTeacher($request){

   try{

    $Teachers=teachers::where('id',$request->id)->update([

        'email'=>$request->Email,
         'password'=>Hash::make($request->Password),
         'Name'=>['en' => $request->Name_en, 'ar' => $request->Name_ar],
         'Specialization_id' => $request->Specialization_id,
         'Gender_id' => $request->Gender_id,
         'Joining_Date' =>$request->Joining_Date,
         'Address' =>$request->Address,
       ]);
      session()->flash('edit',trans('messages.Update'));
      return redirect()->route('teachers.index');
   } catch (Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }


     }
     public function deleteTeacher($id){
         teachers::where('id',$id)->delete();
         session()->flash('delete',trans('messages.Delete'));
         return redirect()->route('teachers.index');

        }


}
