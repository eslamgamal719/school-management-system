<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;

    protected $translatable = ['name'];

    protected $table = 'teachers';

    protected $guarded = [];




    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }


    public function specialisation()
    {
        return $this->belongsTo(Specialisation::class, 'specialisation_id');
    }


    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }

}
