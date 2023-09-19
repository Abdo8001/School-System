<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\Degree;

class EnterExam extends Component
{
    public $student_id,$quizze_id,$data,$counter=0,$questioncount;
    public function render()
    {
     //   dd($this->quizze_id);
        $this->data=Question::where('quizze_id',$this->quizze_id)->get();
      //  dd($this->data);
        $this->questioncount=$this->data->count();
     //   dd($this->questioncount);
        return view('livewire.enter-exam',['data']);
    }
    public function nextQuestion($question_id,$score,$answer,$right_answer){
     $degree_status=Degree::where('student_id',$this->student_id)
     ->where('quizze_id',$this->quizze_id)
     ->first();
    // dd($degree_status);
    //insert
     if($degree_status==null){
        $degree=new Degree();
        $degree->quizze_id=$this->quizze_id;
        $degree->student_id=$this->student_id;
        $degree->question_id=$question_id;
        if(strcmp(trim($answer),trim($right_answer))===0){
            $degree->score+= $score;


        }else{
            $degree->score+= 0;

        }
        $degree->date = date('Y-m-d');
        $degree->save();
     }else{
        // update
        if($degree_status->question_id>=$this->data[$this->counter]->id){
            $degree_status->score = 0;
            $degree_status->abuse = '1';
            $degree_status->save();
            session()->flash('cheats',trans('attendance.test_cheat'));
            return redirect()->route('student_exam.index');

        }else{
            $degree_status->question_id=$question_id;
        if(strcmp(trim($answer),trim($right_answer))===0){
            $degree_status->score+=$score;


        }else{
            $degree_status->score+=0;

        }
        $degree_status->save();
        }

       // return  redirect()->route('student_exam.index');

    }
    if($this->counter<$this->questioncount-1){
        $this->counter++;
    }else{
        session()->flash('done',trans('attendance.test_done'));

        return redirect()->route('student_exam.index');
    }

    }
}
