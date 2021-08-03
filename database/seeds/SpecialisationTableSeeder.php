<?php

use App\Models\Specialisation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialisationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialisations')->delete();

        $specialisations = [
            ['en' => 'Arabic', 'ar' => 'لغة عربية'],
            ['en' => 'Sciences', 'ar' => 'علوم'],
            ['en' => 'Computer', 'ar' => 'حاسب ألى'],
            ['en' => 'English', 'ar' => 'لغة انجليزية']
        ];

        foreach($specialisations as $specialisation) {
            Specialisation::create(['name' => $specialisation]);
        }
    }
}
