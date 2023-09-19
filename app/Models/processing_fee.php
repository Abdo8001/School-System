<?php

namespace App\Models;
use App\Models\student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class processing_fee extends Model
{
 protected $guarded=[];
    use HasFactory;
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
      }
}
