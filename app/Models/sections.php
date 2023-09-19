<?php

namespace App\Models;
use App\Models\Classroom;
use App\Models\teachers;
use App\Models\Grade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sections extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = [];
    protected $table = 'sections';
    public $translatable = ['Name_Section'];
    public $timestamps = true;
    public function My_class()
    {
        return $this->belongsTo(Classroom::class, 'Class_id');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }
    public function teachers()
    {
        return $this->belongsToMany( teachers::class,'teacher_section','section_id','teacher_id');
    }
}
