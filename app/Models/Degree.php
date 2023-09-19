<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function quizze()
    {
        return $this->belongsTo(Quiz::class, 'quizze_id','id');
    }
}
