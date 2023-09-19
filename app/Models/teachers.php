<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\specializations;
use App\Models\genders;
use App\Models\sections;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class teachers extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    protected $guard='teacher';

    protected $guarded = [];
    public $translatable = ['Name'];
    public function genders(){
      return $this->belongsTo(genders::class,'Gender_id');
    }
    public function specializations(){
      return $this->belongsTo(specializations::class,'Specialization_id');
    }

    public function sections()
    {
        return $this->belongsToMany(sections::class,'teacher_section','section_id','teacher_id');
    }
}
