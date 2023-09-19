<?php

namespace App\Models;
 use App\Models\Classroom;
 use App\Models\sections;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    // protected $filiable=['name','notes'];
    protected $guarded = [];
    protected $table = 'grades';
    public $timestamps = true;
    public $translatable = ['name'];
    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class, 'foreign_key','grade_id');
    }
    public function sections()
    {
        return $this->hasMany(sections::class,'Grade_id');
    }

}
