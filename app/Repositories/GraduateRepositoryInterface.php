<?php

namespace App\Repositories;

interface GraduateRepositoryInterface 
{
    public function index();

    public function create();

    //graduate student by soft delete
    public function softDeletes($request);

    //restore graduated student
    public function restoreStudent($request);

    //delete student totally
    public function destroy($id);
}