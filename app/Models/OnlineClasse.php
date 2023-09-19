<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\teachers;
use App\Models\sections;
use App\Models\User;

class OnlineClasse extends Model
{    protected $guarded = [];

    use HasFactory;
    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
      }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'Classroom_id');
      }
    public function section(){
        return $this->belongsTo(sections::class,'section_id');
      }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
      }
      public function teachers(){
        return $this->belongsTo(teachers::class,'teacher_id');
      }
}
