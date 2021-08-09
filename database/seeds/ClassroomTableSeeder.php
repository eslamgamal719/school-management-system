<?php

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> 'First class', 'ar'=> 'الصف الاول'],
            ['en'=> 'Second class', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third class', 'ar'=> 'الصف الثالث'],
        ];

        foreach($classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom,
                'grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
