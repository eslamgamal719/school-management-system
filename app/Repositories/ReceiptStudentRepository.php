<?php

namespace App\Repositories;

use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipts = ReceiptStudent::all();
        return view('pages.receipts.index', compact('receipts'));
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.receipts.create', compact('student'));
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {

            $receipt = ReceiptStudent::create([
                'date'        => date('Y-m-d'),
                'student_id'  => $request->student_id,
                'debit'       => $request->debit,
                'description' => $request->description
            ]);

            FundAccount::create([
                'date'        => date('Y-m-d'),
                'receipt_id'  => $receipt->id,
                'debit'       => $request->debit,
                'credit'      => 0.00,
                'description' => $request->description
            ]);

            StudentAccount::create([
                'date'        => date('Y-m-d'),
                'type'        => 'receipt',
                'student_id'  => $request->student_id,
                'receipt_id'  => $receipt->id,
                'debit'       => 0.00,
                'credit'      => $request->debit,
                'description' => $request->description
            ]);


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt_students.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $receipt = ReceiptStudent::findOrFail($id);
        return view('pages.receipts.edit', compact('receipt'));
    }


    public function update($request, $id)
    {
        DB::beginTransaction();
        try {

            $receipt = ReceiptStudent::where('student_id', $request->student_id)->first();

            $receipt->update([
                'date'        => date('Y-m-d'),
                'debit'       => $request->debit,
                'description' => $request->description
            ]);

            FundAccount::where('receipt_id', $receipt->id)->first()
            ->update([
                'date'        => date('Y-m-d'),
                'debit'       => $request->debit,
                'description' => $request->description
            ]);

            StudentAccount::where('receipt_id', $receipt->id)->first()
            ->update([
                'date'        => date('Y-m-d'),
                'credit'      => $request->debit,
                'description' => $request->description
            ]);

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('receipt_students.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            ReceiptStudent::findOrFail($id)->delete();
       
            toastr()->success(trans('messages.delete'));
            return redirect()->route('receipt_students.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}