<?php 

namespace App\Http\Controllers\Classrooms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $grades = Grade::all();
      $classes = Classroom::all();
      return view('pages.classes.index', compact('classes', 'grades'));
  }


  public function filter_classes(Request $request) 
  {
      $grade_id = $request->grade_id;
      $grades = Grade::all();
      $classes = Classroom::where('grade_id', $grade_id)->get();
      return view('pages.classes.index', compact('classes', 'grades')); 
  }
  

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ClassroomRequest $request)
  {
    try {
      $list_classes = $request->List_Classes;

      foreach($list_classes as $list_class) {
        Classroom::create([
          'name' => ['en' => $list_class['name_en'], 'ar' => $list_class['name']],
          'grade_id' => $list_class['grade_id']
        ]);
      }

      toastr()->success(trans('messages.success'));
      return redirect()->route('classrooms.index');

    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }



  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(UpdateClassroomRequest $request, $id)
  {
      try {
        $classroom = Classroom::findOrFail($id);

        $classroom->update([
          'name' => ['ar' => $request->name, 'en' => $request->name_en],
          'grade_id' => $request->grade_id
        ]);

        toastr()->success(trans('messages.update'));
        return redirect()->route('classrooms.index');

      }catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  { 
    try {
        $classroom = Classroom::findOrFail($id)->delete();

        toastr()->success(trans('messages.delete'));
        return redirect()->route('classrooms.index');

    }catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }



  public function delete_all(Request $request)
  {
    try {
        $ids = $request->delete_all_id;

        $ids_array = explode(',', $ids);
        
        Classroom::whereIn('id', $ids_array)->delete();

        toastr()->success(trans('messages.delete'));
        return redirect()->route('classrooms.index');

      } catch(\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }



  

}

