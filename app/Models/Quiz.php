<?php

namespace App\Models;
use App\Models\teachers;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Subject;
use App\Models\Degree;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{
    use HasFactory;
    use HasTranslations;
    public $primaryKey = 'quizze_id';

    protected $guarded = [];
    public $translatable = ['name'];
    public function grades(){

        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classroom(){

        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function teachers(){

        return $this->belongsTo(teachers::class,'teacher_id');
    }
    public function subject(){

        return $this->belongsTo(Subject::class,'subject_id');
    }
    public function section(){

        return $this->belongsTo(sections::class,'section_id');
    }
    public function degrees(){

     return   $this->hasMany(Degree::class, 'quizze_id', 'id');
      }
}
