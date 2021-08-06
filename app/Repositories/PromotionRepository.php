<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $data['grades'] = Grade::all();
        return view('pages.students.promotions.index', $data);
    }

    public function store($request)
    {   
        DB::beginTransaction();
        try {
                $students = Student::where('grade_id', $request->grade_id)
                ->where('classroom_id', $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)->get();

                if($students->count() < 1) {
                    return redirect()->back()->with('error_promotions', __('site.error_promotions'));
                }

                foreach($students as $student) {
                    $ids = explode(',', $student->id);  //[1,2,3,...]

                    Student::whereIn('id', $ids)->update([
                        'grade_id'      => $request->grade_id_new,
                        'classroom_id'  => $request->classroom_id_new,
                        'section_id'    => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                    Promotion::updateOrCreate([
                        'student_id'        => $student->id,
                        'from_grade'        => $request->grade_id,
                        'from_classroom'    => $request->classroom_id,
                        'from_section'      => $request->section_id,
                        'to_grade'          => $request->grade_id_new,
                        'to_classroom'      => $request->classroom_id_new,
                        'to_section'        => $request->section_id_new,
                        'academic_year'     => $request->academic_year,
                        'academic_year_new' => $request->academic_year_new,
                    ]);
                }

                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->back();

        }catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}