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

        $grades = [
            ['en' => 'Laboratory School', 'ar' => 'المرحلة الابتدائية'],
            ['en' => 'Primary School', 'ar' => 'المرحلة الاعدادية'],
            ['en' => 'Secondary School', 'ar' => 'المرحلة الثانوية']
        ];

        foreach($grades as $grade) {
            Grade::create([
                'name' => $grade,
            ]);
        }

    }
}
