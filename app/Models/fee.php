<?php

namespace App\Models;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class fee extends Model
{

     use HasTranslations;
    public $translatable = ['title'];
    protected $guarded = [];

    use HasFactory;
    public function grades(){
        return $this->belongsTo(Grade::class,'Grade_id');
      }
    public function Classrooms(){
        return $this->belongsTo(Classroom::class,'Classroom_id');
      }

}
