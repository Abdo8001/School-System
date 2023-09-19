<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\genders;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Nationalitie;
use App\Models\my__parents;
use App\Models\Student;
use App\Models\StudentsAttendance;
class StudentsAttendance extends Model
{
    protected $guarded = [];
     use HasFactory;

public function students(){
     return $this->belongsTo(Student::class, 'student_id');


}
public function grade(){
     return $this->belongsTo(Grade::class, 'grade_id');


}
public function section(){
     return $this->belongsTo(sections::class, 'section_id');


}

    }
