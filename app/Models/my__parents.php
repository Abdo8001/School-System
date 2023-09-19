<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class my__parents extends Authenticatable
{
    use HasTranslations;

    use HasFactory;
    protected $table='myparents';
    protected $guarded=[];
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];

}
