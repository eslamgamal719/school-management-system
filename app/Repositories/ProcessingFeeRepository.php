<?php

namespace App\Repositories;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $processingFees = ProcessingFee::all();
        return view('pages.processing_fee.index', compact('processingFees'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.processing_fee.create', compact('student'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            $processing = ProcessingFee::create([
                'date'        => date('Y-m-d'),
                'student_id'  => $request->student_id,
                'amount'      => $request->debit,
                'description' => $request->description
            ]);

            StudentAccount::create([
                'date'          => date('Y-m-d'),
                'type'          => 'processing',
                'student_id'    => $request->student_id,
                'processing_id' => $processing->id,
                'debit'         => 0.00,
                'credit'        => $request->debit,
                'description'   => $request->description
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('processing_fees.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $processingFee = ProcessingFee::findOrFail($id);
        return view('pages.processing_fee.edit', compact('processingFee'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            ProcessingFee::findOrFail($id)
            ->update([
                'date'        => date('Y-m-d'),
                'amount'      => $request->debit,
                'description' => $request->description
            ]);

            StudentAccount::where('processing_id', $id)
            ->update([
                'date'          => date('Y-m-d'),
                'credit'        => $request->debit,
                'description'   => $request->description
            ]);

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('processing_fees.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            ProcessingFee::findOrFail($id)->delete();
           
            toastr()->success(trans('messages.delete'));
            return redirect()->route('processing_fees.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}