<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model 
{
    use HasTranslations;

    protected $table = 'classrooms';

    protected $fillable = ['name', 'grade_id'];

    public $translatable = ['name'];

    public $timestamps = true;

    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id');
    }



}