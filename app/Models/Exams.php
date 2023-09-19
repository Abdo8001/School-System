<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Exams extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];

}
