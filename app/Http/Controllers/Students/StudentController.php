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

    public function index()
    {
        return $this->student->getAllStudents();
    }
 
    public function create()
    {
        return $this->student->createStudent();
    }
 
    public function store(StudentRequest $request)
    {
        return $this->student->storeStudent($request);
    }

    public function show($id)
    {
        return $this->student->showStudent($id);
    }

    public function edit($id)
    {
        return $this->student->editStudent($id);
    }

    public function update(StudentRequest $request, $id)
    {
        return $this->student->updateStudent($request, $id);
    }

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

    public function graduate_student($id)
    {
        return $this->student->graduateStudent($id);
    }
}
