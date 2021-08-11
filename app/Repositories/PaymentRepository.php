<?php

namespace App\Repositories;

use App\Models\FundAccount;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payments = PaymentStudent::all();
        return view('pages.payments.index', compact('payments'));
    }

    public function show($id)
    {
       $student = Student::findOrFail($id);
       return view('pages.payments.create', compact('student'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            
            $payment = PaymentStudent::create([
                'date'        => date('Y-m-d'),
                'student_id'  => $request->student_id,
                'amount'      => $request->debit,
                'description' => $request->description,
            ]);

            FundAccount::create([
                'date'        => date('Y-m-d'),
                'payment_id'  => $payment->id,
                'credit'      => $request->debit,
                'debit'       => 0.00,
                'description' => $request->description,
            ]);

            StudentAccount::create([
                'date'        => date('Y-m-d'),
                'type'        => 'payment',
                'student_id'  => $request->student_id,
                'payment_id'  => $payment->id,
                'credit'      => 0.00,
                'debit'       => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('payments.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
       $payment = PaymentStudent::findOrFail($id);
       return view('pages.payments.edit', compact('payment'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payment = PaymentStudent::findOrFail($id);
            $payment->update([
                'date'        => date('Y-m-d'),
                'amount'      => $request->debit,
                'description' => $request->description,
            ]);

            FundAccount::where('payment_id', $id)->first()->update([
                'date'        => date('Y-m-d'),
                'credit'      => $request->debit,
                'description' => $request->description,
            ]);

            StudentAccount::where('payment_id', $id)->first()->update([
                'date'        => date('Y-m-d'),
                'debit'       => $request->debit,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messages.update'));
            return redirect()->route('payments.index');

        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {

             PaymentStudent::findOrFail($id)->delete();
           
            toastr()->success(trans('messages.delete'));
            return redirect()->route('payments.index');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}