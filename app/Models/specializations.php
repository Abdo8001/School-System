<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\specializations;
use Spatie\Translatable\HasTranslations;

class specializations extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
}
