<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('grades')->delete();

        Grade::create([
            'name' => ['en' => 'Laboratory School', 'ar' => 'المرحلة الابتدائية'],
        ]);

        Grade::create([
            'name' => ['en' => 'Primary School', 'ar' => 'المرحلة الاعدادية'],
        ]);

        Grade::create([
            'name' => ['en' => 'Secondary School', 'ar' => 'المرحلة الثانوية'],
        ]);
    }
}
