<?php

namespace App\Repositories;

interface StudentRepositoryInterface 
{

    //get all students
    public function getAllStudents();

    //get student
    public function showStudent($id);

    //create new student
    public function createStudent();

    //store new student in DB
    public function storeStudent($request);

    //edit student
    public function editStudent($id);

    //update student
    public function updateStudent($request, $id);

    //delete student
    public function deleteStudent($id);

    //upload student's attachments
    public function uploadArrachments($request);

    //download student's attachment
    public function downloadAttachment($studentName, $fileName);

    //show student's attachment
    public function showAttachment($studentName, $fileName);

    //delete student's attachment
    public function deleteAttachment($request);



    //get classes of grade
    public function get_classes($id);

    //get sections of class
    public function get_sections($classroom_id);



}