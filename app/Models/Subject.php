<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\teachers;
class Subject extends Model
{  use HasTranslations;
    protected $guarded = [];
    public $translatable=['name'];
    use HasFactory;
    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
      }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
      }
    public function teachers(){
        return $this->belongsTo(teachers::class,'teacher_id');
      }
}
