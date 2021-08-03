<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    protected $table = 'sections';

    public $translatable = ['name'];

    protected $fillable = [
        'name', 'grade_id', 'class_id', 'status'
    ];


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
    

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
}
