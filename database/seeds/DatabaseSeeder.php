<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(BloodTableSeeder::class);
         $this->call(ReligionTableSeeder::class);
         $this->call(NationalityTableSeeder::class);
         $this->call(GenderTableSeeder::class);
         $this->call(SpecialisationTableSeeder::class);
         $this->call(GradeTableSeeder::class);
         $this->call(ClassroomTableSeeder::class);
         $this->call(SectionTableSeeder::class);
         $this->call(ParentsTableSeeder::class);
         $this->call(StudentsTableSeeder::class);
    }
}
