<?php

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_parents')->delete();
        MyParent::create([
            'email' =>  'eslamgamal@yahoo.com',
            'password' =>  Hash::make('12345678'),
            'name_father' =>  ['en' => 'Eslam Gamal', 'ar' => 'اسلام جمال'],
            'national_id_father' =>  '1234567810',
            'passport_id_father' =>  '1234567810',
            'phone_father' =>  '1234567810',
            'job_father' =>  ['en' => 'programmer', 'ar' => 'مبرمج'],
            'nationality_father_id' =>  Nationality::all()->unique()->random()->id,
            'blood_type_father_id' => Blood::all()->unique()->random()->id,
            'religion_father_id' =>  Religion::all()->unique()->random()->id,
            'address_father' => 'القاهرة',
            'name_mother' =>  ['en' => 'SS', 'ar' => 'سس'],
            'national_id_mother' =>  '1234567810',
            'passport_id_mother' =>  '1234567810',
            'phone_mother' =>  '1234567810',
            'job_mother' =>  ['en' => 'Teacher', 'ar' => 'معلمة'],
            'nationality_mother_id' =>  Nationality::all()->unique()->random()->id,
            'blood_type_mother_id' => Blood::all()->unique()->random()->id,
            'religion_mother_id' =>  Religion::all()->unique()->random()->id,
            'address_mother' => 'القاهرة',
        ]);

    }
}
