<?php

namespace App\Http\Controllers\teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\genders;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\student_account;
use App\Models\StudentsAttendance;
use App\Models\Student;
use App\Models\teachers;
use App\Models\feeInvoice;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
           $students=Student::whereIn('section_id',$ids)->get();
        return view('pages.teachers.dashboard.students.index',compact('students'));
    }

    public function sections(){
        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections=sections::whereIn('id',$ids)->get();
        return view('pages.teachers.dashboard.sections.sections',compact('sections'));
    }


   public function attendaning(Request $request){
    try{
     //   dd($request);
        $attndance_Date=date('Y-m-d');
        foreach($request->attendences as $studenId=>$attendences){

          if($attendences=='present'){
            $attendence_status=true;

          }elseif($attendences=='absent'){
            $attendence_status=false;
          }
          StudentsAttendance::updateorCreate([
            'student_id'=>$studenId,
            'attendence_date'=>$attndance_Date,

          ],[
            'student_id'=> $studenId,
            'grade_id'=> $request->grade_id,
            'classroom_id'=> $request->classroom_id,
            'section_id'=> $request->section_id,
            'teacher_id'=> auth()->user()->id,
            'attendence_date'=>$attndance_Date,
            'attendence_status'=>$attendence_status
          ]);

        }
        toastr()->success(trans('messages.success'));

        // session()->flash('add',trans('messages.success'));
        return redirect()->route('student_at.all');


    } catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

   }

   public function Edit_Attendaning(Request $request){

    try{
        //dd($request);
        $attndance_Date=date('Y-m-d');
        $attendences=StudentsAttendance::findOrFail($request->id);
      //  dd($attendences);
          if($request->attendences=='present'){
            $attendence_status=true;

          }elseif($request->attendences=='absent'){
            $attendence_status=false;
          }
          $attendences->update([
                         'attendence_status'=>$attendence_status,
                         'attendence_date'=>$attndance_Date,
                ]);



        session()->flash('edit',trans('messages.Update'));
        return redirect()->route('student_at.all');


    } catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
   }

   public function AttendanceReport(){
    $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
    $students=Student::whereIn('section_id',$ids)->get();
return view('pages.teachers.dashboard.students.attendance_report',compact('students'));


   }


public function FindReport(Request $request){

  //  dd($request);
    $request->validate([
        'from' => 'required|date|date_format:Y-m-d',
        'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
    ], [
        'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
        'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    ]);
    $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
    $students=Student::whereIn('section_id',$ids)->get();
    if($request->student_id==0){
        $Students=StudentsAttendance::whereBetween('attendence_date',[$request->from,$request->to])->get();
        return view('pages.teachers.dashboard.students.attendance_report',compact('students','Students'));
    }else {
        $Students=StudentsAttendance::whereBetween('attendence_date',[$request->from,$request->to])->where('student_id',$request->student_id)->get();

        return view('pages.teachers.dashboard.students.attendance_report',compact('students','Students'));

    }
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
