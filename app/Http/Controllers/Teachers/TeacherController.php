<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Gender;
use App\Models\Specialisation;
use App\Repositories\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public $teacher;


    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = $this->teacher->getAllTeachers();
        return view('pages.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialisations = $this->teacher->getSpecialisations();
        $genders = $this->teacher->getGenders();
        return view('pages.teachers.create', compact('specialisations', 'genders')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        return $this->teacher->storeTeacher($request);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialisations = $this->teacher->getSpecialisations();
        $genders = $this->teacher->getGenders();
        $teacher = $this->teacher->editTeacher($id);

        return view('pages.teachers.edit', compact('specialisations', 'genders', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        return $this->teacher->updateTeacher($request, $id);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->teacher->deleteTeacher($id);
    }
}
