<?php

namespace App\Repositories;

use App\Models\Blood;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\MyParent;
use App\Models\Classroom;
use App\Models\Image;
use App\Models\Nationality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAllStudents()
    {
        $students = Student::with(['gender', 'grade', 'classroom', 'section'])->orderBy('id', 'desc')->get();
        return view('pages.students.index', compact('students'));
    }


    public function showStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.students.show', compact('student'));
    }


    public function createStudent()
    {
       $data['grades'] = Grade::all();
       $data['bloods'] = Blood::all();
       $data['genders'] = Gender::all();
       $data['parents'] = MyParent::all();
       $data['nationals'] = Nationality::all();
       
       return view('pages.students.add', $data);
    }


   public function storeStudent($request)
   {
       DB::beginTransaction();

        try {
            $student = Student::create([
                'name'              => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'gender_id'         => $request->gender_id,
                'nationality_id'    => $request->nationality_id,
                'blood_id'          => $request->blood_id,
                'date_birth'        => $request->date_birth,
                'grade_id'          => $request->grade_id,
                'classroom_id'      => $request->classroom_id,
                'section_id'        => $request->section_id,
                'parent_id'         => $request->parent_id,
                'academic_year'     => $request->academic_year,
            ]);

            if($request->hasFile('photos')) {
                foreach($request->photos as $photo) {
                    $name = $photo->getClientOriginalName();
                    $photo->storeAs('attachments/students/' . $request->name_en, $name, 'upload_attachments');

                    Image::create([
                        'filename' => $name,
                        'imageable_id' => $student->id,
                        'imageable_type' => 'App\Models\Student'
                    ]);
                }
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');

        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
   }


   public function editStudent($id)
   {
        $data['bloods'] = Blood::all();
        $data['grades'] = Grade::all();
        $data['genders'] = Gender::all();
        $data['parents'] = MyParent::all();
        $data['nationals'] = Nationality::all();
        $data['student'] = Student::findOrFail($id);
        
        return view('pages.students.edit', $data);
   }


   public function updateStudent($request, $id)
   {
        try {
            $student = Student::findOrFail($id);
            $student->update([
                'name'              => ['en' => $request->name_en, 'ar' => $request->name_ar],
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'date_birth'        => $request->date_birth,
                'academic_year'     => $request->academic_year,
                'blood_id'          => $request->blood_id,
                'grade_id'          => $request->grade_id,
                'parent_id'         => $request->parent_id,
                'gender_id'         => $request->gender_id,
                'section_id'        => $request->section_id,
                'classroom_id'      => $request->classroom_id,
                'nationality_id'    => $request->nationality_id,
            ]);

            toastr()->success(trans('messages.update'));
            return redirect()->route('students.index');

        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
   }


   public function deleteStudent($id)
   {
       try{
            Student::find($id)->forceDelete();  

            toastr()->success(trans('messages.delete'));
            return redirect()->route('students.index');

        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
   }


   public function graduateStudent($id)
   {
        try{
            Student::find($id)->delete();  

            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');

        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
   }



   public function get_classes($grade_id)
   {
       $classes = Classroom::where('grade_id', $grade_id)->pluck('name', 'id');
       return $classes;
   }


   public function get_sections($classroom_id)
   {
       $sections = Section::where('class_id', $classroom_id)->pluck('name', 'id');
       return $sections;
   }


   public function uploadArrachments($request)
   {
       if($request->hasFile('photos')) {
           foreach($request->photos as $photo) {
               $name = $photo->getClientOriginalName();
               $photo->storeAs('attachments/students/' . $request->student_name, $name, 'upload_attachments');

               Image::create([
                'filename' => $name,
                'imageable_id' => $request->student_id,
                'imageable_type' => 'App\Models\Student'
            ]);
           }
       }

       toastr()->success(trans('messages.success'));
       return redirect()->back();
   }


   public function downloadAttachment($studentName, $fileName)
   {
        return response()->download(public_path('attachments/students/' . $studentName . '/' . $fileName));
   }


   public function showAttachment($studentName, $fileName)
   {
        return response()->file(public_path('attachments/students/' . $studentName . '/' . $fileName));
   }


   public function deleteAttachment($request)
   {
        /*if(File::exists(public_path('attachments/students/' . $request->student_name . '/' . $request->filename))) {
           unlink(public_path('attachments/students/' . $request->student_name . '/' . $request->filename));
           Image::findOrFail($request->id)->delete();
       }*/

      Storage::disk('upload_attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->filename);
      Image::findOrFail($request->id)->delete();

       toastr()->success(trans('messages.delete'));
       return redirect()->back();
   }

}