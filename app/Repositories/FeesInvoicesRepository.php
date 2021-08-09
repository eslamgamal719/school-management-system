<?php

namespace App\Repositories;

use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{
    
    public function index()
    {
        $fees_invoices = FeeInvoice::all();
       // $grades = Grade::all();
        return view('pages.fees_invoices.index', compact('fees_invoices'));
    }

    public function show($id) //id of student not invoice
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id', $student->classroom_id)->get();
        return view('pages.fees_invoices.create', compact('fees', 'student'));
    }


    public function store($request)
    {
        $list_fees = $request->List_Fees;
        DB::beginTransaction();

        try {
            foreach($list_fees as $list_fee) {
                $fee = FeeInvoice::create([
                    'invoice_date'  => date('Y-m-d'),
                    'student_id'    => $list_fee['student_id'],
                    'fee_id'        => $list_fee['fee_id'],
                    'amount'        => $list_fee['amount'],
                    'description'   => $list_fee['description'],
                    'grade_id'      => $request->grade_id,
                    'classroom_id'  => $request->classroom_id,
                ]);

                
                StudentAccount::create([
                    'date'          => date('Y-m-d'),
                    'type'          => 'invoice',
                    'fee_invoice_id'=> $fee->id,
                    'student_id'    => $list_fee['student_id'],
                    'debit'         => $list_fee['amount'],
                    'credit'        => 0.00,
                    'description'   => $list_fee['description'],
                ]);
            }

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees_invoices.index');

        }catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $fee_invoice = FeeInvoice::findOrFail($id);
        $fees = Fee::where('classroom_id', $fee_invoice->classroom_id)->get();
        return view('pages.fees_invoices.edit', compact('fee_invoice', 'fees'));
    }


    public function update($request, $id)
    {
            DB::beginTransaction();
        try {
            $fee_invoice = FeeInvoice::findOrFail($id);
            $fee_invoice->update([
                'fee_id'        => $request->fee_id,
                'amount'        => $request->amount,
                'description'   => $request->description,
            ]);

            $sudentAccount = StudentAccount::where('fee_invoice_id', $fee_invoice->id)->first();
            $sudentAccount->update([
                'debit'         => $request->amount,
                'description'   => $request->description,
            ]);
 
            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('fees_invoices.index');

        }catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            FeeInvoice::findOrFail($id)->delete();

            toastr()->success(trans('messages.delete'));
            return redirect()->route('fees_invoices.index');

        }catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function feesAmount($id)
    {
        $amount = Fee::findOrFail($id)->amount;
        return $amount;
    }


}