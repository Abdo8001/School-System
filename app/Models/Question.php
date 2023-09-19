<?php

namespace App\Models;
use App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function quizes(){

        return $this->belongsTo(Quiz::class,'quizze_id');
    }

}
