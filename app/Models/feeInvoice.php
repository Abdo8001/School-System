<?php

namespace App\Models;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\fee;
use App\Models\student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feeInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
      }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'Classroom_id');
      }

    public function fees(){
        return $this->belongsTo(fee::class,'fee_id');
      }
    public function student(){
        return $this->belongsTo(student::class,'student_id');
      }

}
