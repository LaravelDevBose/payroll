<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [ 'workerId','salary_id', 'amount' ];

    public function salary()
    {
    	return $this->belongsTo(SalaryInfo::class, 'salary_id');
    }
}
