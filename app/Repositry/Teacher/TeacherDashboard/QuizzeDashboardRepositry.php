<?php
namespace App\Repositry\Teacher\TeacherDashboard;
use  App\Interface\Teacher\TeacherDashboard\QuizzeDashboardRepositryInterface;

use App\Models\Quiz;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Subject;
use App\Models\Degree;

use App\Models\Question;



class QuizzeDashboardRepositry implements QuizzeDashboardRepositryInterface
{
    public function index(){
        $quizes=Quiz::where('teacher_id',auth()->user()->id)->get();
        return view('pages.teachers.dashboard.Quizzes.index',compact('quizes'));
    }
    public function create(){
        $data['grades']=Grade::all();
        $data['teachers']=teachers::all();
        $data['subjects']=Subject::all();
        return view('pages.teachers.dashboard.Quizzes.create',['data'=>$data]);
    }
    public function show($id){
       $questions=Question::where('quizze_id',$id)->get();
       $quizz=Quiz::findOrFail($id);
       return view('pages.teachers.dashboard.Questions.index',compact('questions','quizz'));
    }

    public function edit($id){
        $quizz=Quiz::findOrFail($id);
        $data['grades']=Grade::all();
        $data['teachers']=teachers::all();
        $data['subjects']=Subject::all();
        return view('pages.teachers.dashboard.Quizzes.edit',['quizz'=>$quizz,'data'=>$data]);
    }

    public function store( $request){
        try{
           // dd($request);
            $quiz=new Quiz();
            $quiz->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $quiz->subject_id=$request->subject_id;
            $quiz->teacher_id=auth()->user()->id;
            $quiz->Grade_id=$request->Grade_id;
            $quiz->Classroom_id=$request->Classroom_id;
            $quiz->section_id=$request->section_id;
            $quiz->save();
            session()->flash('add',trans('messages.success'));
            return redirect()->route('quizzes.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function update($request){
    // dd($request);
        try{
            $quiz= Quiz::findOrFail($request->id);
            $quiz->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $quiz->subject_id=$request->subject_id;
            $quiz->teacher_id=auth()->user()->id;
            $quiz->Grade_id=$request->Grade_id;
            $quiz->Classroom_id=$request->Classroom_id;
            $quiz->section_id=$request->section_id;
            $quiz->save();
            session()->flash('edit',trans('messages.Update'));
            return redirect()->route('quizzes.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function destroy($request){

        Quiz::destroy($request->id);
        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('quizzes.index');
    }
public function getAllSections($id){
    $sections=sections::where('Class_id',$id)->pluck('Name_Section','id');
    // dd($sections);
        return $sections;

    }
public function getClasses($id){
    $list_classes=Classroom::where('grade_id',$id)->pluck('calss_name','id');
    return $list_classes;

    }
    public function show_tested($id){
      $degrees=Degree::where('quizze_id',$id)->get();
      return view('pages.teachers.dashboard.Quizzes.student_tested',compact('degrees'));
    }
    public function repeat_test($request,$id){

        Degree::where('student_id',$request->student_id)->where('quizze_id',$request->quizze_id)->delete();
        session()->flash('delete',trans('messages.Delete'));
        return  redirect()->route('show_tested_student',$request->quizze_id);
    }

}
