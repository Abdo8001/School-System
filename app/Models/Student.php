<?php

namespace App\Models;
use App\Models\genders;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\student_account;
use App\Models\StudentsAttendance;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Student extends Authenticatable
{
    use SoftDeletes;
//use Authenticatable;
    use HasFactory;
    use HasTranslations;
    protected $guard='student';
    protected $guarded = [];
    public $translatable=['name'];
    public function gender(){
        return $this->belongsTo(genders::class,'gender_id');
      }
    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
      }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'Classroom_id');
      }
    public function section(){
        return $this->belongsTo(sections::class,'section_id');
      }
    public function Nationality(){
        return $this->belongsTo(Nationalitie::class,'nationalitie_id');
      }
    public function myparent(){
        return $this->belongsTo(my__parents::class,'parent_id');
      }
         // علاقة بين الطلاب والصور لجلب اسم الصور  في جدول الطلاب
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
    public function student_account(){
        return $this->hasMany(student_account::class,'student_id');
      }
      public function attendance(){

        return $this->hasMany(StudentsAttendance::class,'student_id');
      }

}
