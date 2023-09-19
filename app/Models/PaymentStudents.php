<?php

namespace App\Models;
use App\Models\student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStudents extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function student(){

        return $this->belongsTo(student::class,'student_id');
    }
}
