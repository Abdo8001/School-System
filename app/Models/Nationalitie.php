<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalitie extends Model
{
    use HasFactory;
    protected $fillable =['national_name'];

    use HasTranslations;
    public $translatable = ['national_name'];

}
