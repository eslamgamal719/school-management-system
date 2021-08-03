<?php

namespace App\Repositories;

use App\Models\Gender;
use App\Models\Specialisation;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }


    public function getGenders()
    {
        return Gender::all();
    }


    public function getSpecialisations()
    {
        return Specialisation::all();
    }


    public function storeTeacher($request)
    {
        try {
            Teacher::create([
                'email'             => $request->email,
                'password'          =>  Hash::make($request->password),
                'name'              => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'specialisation_id' => $request->specialisation_id,
                'gender_id'         => $request->gender_id,
                'joining_date'      => $request->joining_date,
                'address'           => $request->address,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.create');
        
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function editTeacher($id)
    {
        return Teacher::findOrFail($id); 
    }


    public function updateTeacher($request, $id)
    {
        try{
            $teacher = Teacher::findOrFail($id);

            $teacher->update([
                'email'             => $request->email,
                'password'          =>  Hash::make($request->password),
                'name'              => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'specialisation_id' => $request->specialisation_id,
                'gender_id'         => $request->gender_id,
                'joining_date'      => $request->joining_date,
                'address'           => $request->address,
            ]);

            toastr()->success(trans('messages.update'));
            return redirect()->route('teachers.index');
        
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function deleteTeacher($id) 
    {
        try{
            Teacher::findOrFail($id)->delete();

            toastr()->success(trans('messages.delete'));
            return redirect()->route('teachers.index');
        
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


}