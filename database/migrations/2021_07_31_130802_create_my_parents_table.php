<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('name_father');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->bigInteger('nationality_father_id')->unsigned();
            $table->foreign('nationality_father_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->bigInteger('blood_type_father_id')->unsigned();
            $table->foreign('blood_type_father_id')->references('id')->on('bloods')->onDelete('cascade');
            $table->bigInteger('religion_father_id')->unsigned();
            $table->foreign('religion_father_id')->references('id')->on('religions')->onDelete('cascade');
            $table->string('address_father');

            //Mother information
            $table->string('name_mother');
            $table->string('national_id_mother');
            $table->string('passport_id_mother');
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->bigInteger('nationality_mother_id')->unsigned();
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->bigInteger('blood_type_mother_id')->unsigned();
            $table->foreign('blood_type_mother_id')->references('id')->on('bloods')->onDelete('cascade');
            $table->bigInteger('religion_mother_id')->unsigned();
            $table->foreign('religion_mother_id')->references('id')->on('religions')->onDelete('cascade');
            $table->string('address_mother');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_parents');
    }
}
