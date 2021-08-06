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
}
