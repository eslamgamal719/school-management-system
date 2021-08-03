<?php

namespace App\Repositories;

interface TeacherRepositoryInterface 
{
    //get all teachers
    public function getAllTeachers();


    //get specialisations
    public function getSpecialisations();


    //get genders
    public function getGenders();


    //store teacher
    public function storeTeacher($request);


    //edit teacher
    public function editTeacher($id);


    //update teacher
    public function updateTeacher($request, $id);


    //delete teacher
    public function deleteTeacher($id);
}