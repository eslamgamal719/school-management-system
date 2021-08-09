<?php

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('students')->delete();
        Student::create([
            'name' => ['ar' => 'احمد على', 'en' => 'Ahmed Ali'],
            'email' => 'ahmed@yahoo.com',
            'password' => Hash::make('12345678'),
            'gender_id' => 1,
            'nationality_id' => Nationality::all()->unique()->random()->id,
            'blood_id' =>Blood::all()->unique()->random()->id,
            'date_birth' => date('1995-01-01'),
            'grade_id' => Grade::all()->unique()->random()->id,
            'classroom_id' =>Classroom::all()->unique()->random()->id,
            'section_id' => Section::all()->unique()->random()->id,
            'parent_id' => MyParent::all()->unique()->random()->id,
            'academic_year' =>'2021',
        ]);
        
    }
}
