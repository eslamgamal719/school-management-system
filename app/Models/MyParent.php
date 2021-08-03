<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasTranslations;

    protected $translatable = ['name_father','job_father', 'name_mother','job_mother'];
    
    protected $table = 'my_parents';

    protected $guarded = [];
}
