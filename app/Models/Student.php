<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use SoftDeletes;
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }


    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }


    public function blood()
    {
        return $this->belongsTo(Blood::class, 'blood_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    

    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }



}
