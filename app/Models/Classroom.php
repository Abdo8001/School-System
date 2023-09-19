<?php

namespace App\Models;
// use App\Models\Grade;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['calss_name'];
    protected $table = 'Classrooms';
    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id');
    }

}
