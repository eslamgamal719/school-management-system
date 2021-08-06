<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repositories\StudentRepositoryInterface;

class StudentController extends Controller
{

    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->student->getAllStudents();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->student->createStudent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return $this->student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        return $this->student->updateStudent($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->student->deleteStudent($id);
    }


    public function get_classes($id)
    {
        return $this->student->get_classes($id);
    }


    public function get_sections($id)
    {
        return $this->student->get_sections($id);
    }


    public function upload_attachments(Request $request)
    {
        return $this->student->uploadArrachments($request);
    }


    public function download_attachment($studentName, $fileName)
    {
        return $this->student->downloadAttachment($studentName, $fileName);
    }


    public function show_attachment($studentName, $fileName)
    {
        return $this->student->showAttachment($studentName, $fileName);
    }


    public function delete_attachment(Request $request)
    {
        return $this->student->deleteAttachment($request);
    }
}
