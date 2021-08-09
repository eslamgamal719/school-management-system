<?php

namespace App\Repositories;

use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();
        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $grades = Grade::select('name', 'id')->get();
        return view('pages.fees.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            Fee::create([
                'title'         => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'        => $request->amount,
                'grade_id'      => $request->grade_id,
                'classroom_id'  => $request->classroom_id,
                'year'          => $request->year,
                'fee_type'      => $request->fee_type,
                'description'   => $request->description,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $grades = Grade::select('name', 'id')->get();
        return view('pages.fees.edit', compact('grades', 'fee'));
    }

    public function update($request, $id)
    {
        try {
            $fee = Fee::findOrFail($id);
            $fee->update([
                'title'         => ['en' => $request->title_en, 'ar' => $request->title_ar],
                'amount'        => $request->amount,
                'grade_id'      => $request->grade_id,
                'classroom_id'  => $request->classroom_id,
                'year'          => $request->year,
                'fee_type'      => $request->fee_type,
                'description'   => $request->description,
            ]);

            toastr()->success(trans('messages.update'));
            return redirect()->route('fees.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Fee::findOrFail($id)->delete();
           
            toastr()->success(trans('messages.delete'));
            return redirect()->route('fees.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}