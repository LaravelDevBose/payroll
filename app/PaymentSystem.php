<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSystem extends Model
{
    protected $fillable = [
        'id','paymentTitle', 'duration','unit' ,'status', 
    ];

    public function worker()
    {
    	return $this->hasMany(WorkerPaymentInfo::class, 'paymentType', 'id');
    }
}
