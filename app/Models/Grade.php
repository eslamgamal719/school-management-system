<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model 
{
    use HasTranslations;
    
    protected $table = 'grades';

    
    public $translatable = ['name'];
    

    protected $fillable = [
        'name', 'notes'
    ];

    public $timestamps = true;


    public function classrooms() 
    {
        return $this->hasMany(Classroom::class, 'grade_id');
    }

    public function sections() 
    {
        return $this->hasMany(Section::class, 'grade_id');
    }

}