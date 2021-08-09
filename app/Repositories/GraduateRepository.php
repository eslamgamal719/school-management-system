<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class GraduateRepository implements GraduateRepositoryInterface
{

    public function index()
    {
        $graduates = Student::onlyTrashed()->get();
        return view('pages.students.graduates.index', compact('graduates'));
    }

    public function create()
    {
        $grades = Grade::select('id', 'name')->get();
        return view('pages.students.graduates.create', compact('grades'));
    }

    public function softDeletes($request)
    {
        $students = Student::where('grade_id', $request->grade_id)
        ->where('classroom_id', $request->classroom_id)
        ->where('section_id', $request->section_id)->get();

        if($students->count() < 1) {
            return redirect()->back()->with('error_graduated', __('site.error_graduated'));
        }
        
        foreach($students as $student) {
            Student::whereId($student->id)->delete();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('graduates.index');
    }


    public function restoreStudent($request)
    {
        Student::onlyTrashed()->whereId($request->id)->first()->restore();

        toastr()->success(trans('messages.success'));
        return redirect()->route('graduates.index');
    }
    
    
    public function destroy($id)
    {
        Student::onlyTrashed()->whereId($id)->first()->forceDelete();

        toastr()->success(trans('messages.delete'));
        return redirect()->route('graduates.index');
    }
}