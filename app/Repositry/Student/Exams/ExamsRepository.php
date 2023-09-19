<?php
namespace App\Repositry\Student\Exams;
use App\Interface\Student\Exams\ExamsRepositoryInterface;


use App\Models\Quiz;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Calssroom;
use App\Models\sections;
use App\Models\Subject;






class  ExamsRepository implements ExamsRepositoryInterface
{
    public function index(){
        // dd(auth()->user());
        $quizzes=Quiz::where('grade_id',auth()->user()->Grade_id)
        ->where('classroom_id',auth()->user()->Classroom_id)
        ->where('section_id',auth()->user()->section_id)
        ->orderBy('id','DESC')
        ->get();
   //     dd($quizzes);
        return view('pages.student.dashboard.exams',compact('quizzes'));
    }
    public function create(){
        //
    }
    public function show($quizze_id){
        $student_id=auth()->user()->id;

        return view('pages.student.dashboard.show',compact('quizze_id','student_id'));
    }

    public function edit($id){
        //
    }

    public function store( $request){

        //
    }

    public function update($request){
        //
    }

    public function destroy($request){
        //
    }

}
