<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    
    protected $table = 'promotions';

    protected $fillable = [
        'student_id', 
        'from_grade', 
        'from_classroom', 
        'from_section', 
        'to_grade', 
        'to_classroom', 
        'to_section',
        'academic_year',
        'academic_year_new'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function f_grade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function f_classroom()
    {
        return $this->belongsTo(Classroom::class, 'from_classroom');
    }

    public function f_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function t_grade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function t_classroom()
    {
        return $this->belongsTo(Classroom::class, 'to_classroom');
    }

    public function t_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
