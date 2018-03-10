<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerPaymentInfo extends Model
{
    protected $fillable = [
        'workerId', 'paymentType','amount','overtimeAmount','timeLimit','accountNumber'
    ];

    
}
