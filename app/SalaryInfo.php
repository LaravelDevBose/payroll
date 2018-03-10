<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryInfo extends Model
{
    protected $fillable = ['workerId','paymentType_id','salaryTo','salaryFrom','present','overtime','basicSalary',
    'overtimeSalary,','totalSalary','status'];



    public function worker()
	{
		return $this->hasOne(WorkarBasicInfo::class, 'id', 'workerId');
	}

	public function paymentType()
	{
		return $this->belongsTo(PaymentSystem::class, 'paymentType_id', 'id');
	}

	public function paymentHistory()
	{
		return $this->hasMany(paymentHistory::class, 'salary_id', 'id');
		
	}

}

