<?php

namespace App\Http\Controllers\Sections;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Teacher;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        $list_grades = Grade::all();
        $grades = Grade::with(['sections'])->get();
        return view('pages.sections.index', compact('grades', 'list_grades', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        try {
            $section = Section::create([
                'name' => ['ar' => $request->name, 'en' => $request->name_en],
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'status' => 1
            ]);
            $section->teachers()->attach($request->teacher_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $section)
    {
        try {
            $section->update([
                'name' => ['ar' => $request->name, 'en' => $request->name_en],
                'grade_id' => $request->grade_id,
                'class_id' => $request->class_id,
                'status' => $request->status ?? 'on' ? 1 : 0
            ]);

            if(isset($request->teacher_id)) {
                $section->teachers()->sync($request->teacher_id);
            }else {
                $section->teachers()->sync(array());
            }

            toastr()->success(trans('messages.update'));
            return redirect()->route('sections.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();

            toastr()->success(trans('messages.delete'));
            return redirect()->route('sections.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function get_classes($grade_id)
    {
        $classes = Classroom::where('grade_id', $grade_id)->pluck('name', 'id');
        return $classes;
    }
}
