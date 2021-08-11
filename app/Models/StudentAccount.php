<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    
    protected $table = 'student_accounts';

    protected $fillable = [
        'date', 
        'type', 
        'fee_invoice_id', 
        'receipt_id', 
        'processing_id', 
        'student_id',
        'payment_id', 
        'debit', 
        'credit', 
        'description'
    ];


 

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
