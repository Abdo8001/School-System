<?php
namespace App\Repositry\Quizes;
use App\Models\Question;

use App\Models\Quiz;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Calssroom;
use App\Models\sections;
use App\Models\Subject;






class QuestionRepository implements QuestionRepositoryInterface
{
    public function index(){
       $questions=Question::all();
       return view('pages.Questions.index',compact('questions'));
    }
    public function create(){
        $quizes=Quiz::all();
        return view('pages.Questions.create',compact('quizes'));
    }
    public function show($id){
        //
    }

    public function edit($id){
        $question=Question::findOrFail($id);
        $quizes=Quiz::all();
return view('pages.Questions.edit',compact('question','quizes'));
    }

    public function store( $request){
       try{
        $question=new Question();
        $question->title=$request->title;
        $question->answers=$request->answers;
        $question->right_answer=$request->right_answer;
        $question->quizze_id=$request->quizze_id;
        $question->score=$request->score;
        $question->save();

        session()->flash('add',trans('messages.success'));
        return redirect()->route('question.index');
   } catch (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }

    }

    public function update($request){
        try{
            $question= Question::findOrFail($request->id);
            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->quizze_id=$request->quizze_id;
            $question->score=$request->score;
            $question->save();

            session()->flash('edit',trans('messages.Update'));
            return redirect()->route('question.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function destroy($request){
        Question::destroy($request->id);

        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('question.index');
    }

}
