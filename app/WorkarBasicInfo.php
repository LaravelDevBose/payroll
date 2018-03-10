<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkarBasicInfo extends Model
{
    protected $fillable = [
        'workerViewId', 
        'name',
        'gender',
        'depertmentId',
        'image',
        'fringerPrint',
    ];

    public function workerPaymentInfo(){
        return $this->hasOne(WorkerPaymentInfo::class, 'workerId');
    }

    public function depertment()
    {
    	return $this->belongsTo(Depertment::class,'depertmentId', 'id');
    }

    public function salarys()
    {
        return $this->hasMany(SalaryInfo::class, 'workerId');
    }

    public function paymentHistory()
    {
        return $this->hasMany(PaymentHistory::class, 'workerId');
    }
}
