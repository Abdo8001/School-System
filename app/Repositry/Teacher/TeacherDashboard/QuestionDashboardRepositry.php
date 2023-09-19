<?php
namespace App\Repositry\Teacher\TeacherDashboard;
use  App\Interface\Teacher\TeacherDashboard\QuestionDashboardRepositryInterface;

use App\Models\Quiz;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Subject;

use App\Models\Question;






class  QuestionDashboardRepositry implements QuestionDashboardRepositryInterface
{
    public function index(){
        //
    }
    public function create(){
        //
    }
    public function show($id){
     $quizz_id=Quiz::findOrFail($id);
     return view('pages.teachers.dashboard.Questions.create',compact('quizz_id'));

    }

    public function edit($id){
        $question=Question::findOrFail($id);
return view('pages.teachers.dashboard.Questions.edit',compact('question'));
    }

    public function store( $request){
    //  dd($request);
        try{
            $question=new Question();
            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->quizze_id=$request->quizz_id;
            $question->score=$request->score;
            $question->save();

            session()->flash('add',trans('messages.success'));
            return redirect()->route('quizzes.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }    }

    public function update($request,$id){
            //  dd($request);

        try{
            $question= Question::findOrFail($id);
            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->score=$request->score;
            $question->save();

            session()->flash('edit',trans('messages.Update'));
            return redirect()->route('quizzes.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function destroy($request){
        Question::destroy($request->id);

        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('quizzes.index');

    }

}
