<?php
namespace App\Repositry\Attendance;

use App\Models\teachers;
use App\Models\Nationalitie;
use App\Models\Grade;
use App\Models\sections;
use App\Models\Student;
use App\Models\StudentsAttendance;


use  App\Interface\Attendance\AttendanceRepositoryInterface;


class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index(){
        $Grades = Grade::with(['Sections'])->get();
      $list_Grades =Grade::all();
      $teachers=teachers::all();
      return view('pages.Attendance.Sections',compact('teachers','Grades','list_Grades'));

    }

    public function show($id){
    $students=Student::with('attendance')->where('section_id',$id)->get();
    return view('pages.Attendance.index',compact('students'));

    }

    public function edit($id){
        //
    }

    public function store( $request){
  //     dd($request);
        try{
            $attndance_Date=date('Y-m-d');
            foreach($request->attendences as $studenId=>$attendences){
              if($attendences=='present'){
                $attendence_status=true;

              }elseif($attendences=='absent'){
                $attendence_status=false;
              }
              StudentsAttendance::create([
                'student_id'=> $studenId,
                'grade_id'=> $request->grade_id,
                'classroom_id'=> $request->classroom_id,
                'section_id'=> $request->section_id,
                'teacher_id'=> 1,
                'attendence_date'=>$attndance_Date,
                'attendence_status'=>$attendence_status
              ]);

            }
            session()->flash('add',trans('messages.success'));
            return redirect()->route('students_Attendance.index');


        } catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        //
    }

    public function destroy($request){
        //
    }

}
