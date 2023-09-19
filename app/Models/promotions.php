<?php

namespace App\Models;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\sections;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotions extends Model
{
    use HasFactory;
    protected $guarded = [];
        //   the old promoted grade

    public function gradeFrom(){
        return $this->belongsTo(Grade::class,'from_grade');
      }
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
      }
    public function Acdmic(){
        return $this->belongsTo(Student::class,'academic_year');
      }
    //   the new promoted grade
    public function gradeTo(){
        return $this->belongsTo(Grade::class,'to_grade');
      }
    public function FromClassroom(){
        return $this->belongsTo(Classroom::class,'from_Classroom');
      }
    public function ToClassroom(){
        return $this->belongsTo(Classroom::class,'to_Classroom');
      }
    public function FromSection(){
        return $this->belongsTo(sections::class,'from_section');
      }
    public function ToSection(){
        return $this->belongsTo(sections::class,'to_section');
      }
}
