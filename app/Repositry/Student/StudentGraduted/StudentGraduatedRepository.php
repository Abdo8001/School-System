<?php

namespace  App\Repositry\Student\StudentGraduted;
use App\Models\Grade;
use App\Models\promotions;
use App\Models\Student;
use  App\Interface\Student\StudentGraduted\StudentGraduatedRepositoryInterface;

class   StudentGraduatedRepository implements StudentGraduatedRepositoryInterface {

        // show all graduted students
        public function ShowAll(){
            $students= Student::onlyTrashed()->get();
            return  view('pages.student.Graduated.index',compact('students'));

        }
        // MakeGradute student
        public function MakeGradute(){
            $Grades=Grade::all();
            return view('pages.student.Graduated.create',compact('Grades'));
        }
        // softdelte function
        public function MakeStudentGraduted($request){
       //  dd($request);
       $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
         if($students->count()<1){
                 return redirect()->back()->withErrors(trans('messages.nomatch'));

           }
           foreach($students as $student){
            $ids=explode(',',$student->id);
            Student::whereIn('id',$ids)->Delete();

           }
           session()->flash('promotion',trans('messages.promotion'));
           return  redirect()->route('students.index');


        }

        // undo gradution
        public function gradutionRollBack($request){
            try{
                Student::withTrashed()->where('id',$request->id)->restore();
                session()->flash('update',trans('messages.Update'));
                return  redirect()->route('students.index');
            }catch (\Exception $e) {

                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        // pramently delete for student
        public function destroy_student($request){
            Student::where('id',$request->student_id)->forcedelete();
            session()->flash('delete',trans('messages.Delete'));
            return  redirect()->route('students.index');
        }
}
