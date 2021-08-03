<?php 

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;


class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades = Grade::paginate(10); 
    return view('pages.grades.index', compact('grades'));
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
  public function store(StoreGrades $request)
  {
    try {

      Grade::create([
          'name'  => ['en' => $request->name_en, 'ar' => $request->name],
          'notes' => $request->notes
      ]);

      toastr()->success(trans('messages.success'));

      return redirect()->route('grades.index');

    }catch(\Exception $e) {
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
  public function update(StoreGrades $request, $id)
  {
      try {
    
        $grade = Grade::findOrFail($id);

        $grade->update([
          'name'  => ['en' => $request->name_en, 'ar' => $request->name],
          'notes' => $request->notes
        ]);

        toastr()->success(trans('messages.update'));

        return redirect()->route('grades.index');

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
      try{
          $grade = Grade::findOrFail($id);
         
          if(count($grade->classrooms) > 0) {
            toastr()->error(trans('messages.delete_classes_before'));

            return redirect()->route('grades.index');
          }
          
          $grade->delete();

          toastr()->error(trans('messages.delete'));

          return redirect()->route('grades.index');

      }catch( \Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }
  

}

