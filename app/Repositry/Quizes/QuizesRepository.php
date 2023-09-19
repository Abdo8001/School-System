<?php
namespace App\Repositry\Quizes;

use App\Models\Quiz;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Calssroom;
use App\Models\sections;
use App\Models\Subject;




class QuizesRepository implements QuizesRepositoryInterface
{
    public function index(){
        $quizes=Quiz::all();
        return view('pages.Quizzes.index',compact('quizes'));
    }
    public function create(){
        $data['grades']=Grade::all();
        $data['teachers']=teachers::all();
        $data['subjects']=Subject::all();
        return view('pages.Quizzes.create',['data'=>$data]);
    }
    public function show($id){
        //
    }

    public function edit($id){
        $quiz=Quiz::findOrFail($id);
        $data['grades']=Grade::all();
        $data['teachers']=teachers::all();
        $data['subjects']=Subject::all();
        return view('pages.Quizzes.edit',['quiz'=>$quiz,'data'=>$data]);
    }

    public function store( $request){
        try{
            $quiz=new Quiz();
            $quiz->name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $quiz->subject_id=$request->subject_id;
            $quiz->teacher_id=$request->teacher_id;
            $quiz->Grade_id=$request->Grade_id;
            $quiz->Classroom_id=$request->Classroom_id;
            $quiz->section_id=$request->section_id;
            $quiz->save();
            session()->flash('add',trans('messages.success'));
            return redirect()->route('quizes.index');
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
            $quiz->teacher_id=$request->teacher_id;
            $quiz->Grade_id=$request->Grade_id;
            $quiz->Classroom_id=$request->Classroom_id;
            $quiz->section_id=$request->section_id;
            $quiz->save();
            session()->flash('edit',trans('messages.Update'));
            return redirect()->route('quizes.index');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function destroy($request){

        Quiz::destroy($request->id);
        session()->flash('delete',trans('messages.Delete'));
        return redirect()->route('quizes.index');
    }

}
