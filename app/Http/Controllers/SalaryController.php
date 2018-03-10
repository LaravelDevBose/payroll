<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentHistory;
use App\SalaryInfo;
use App\PaymentSystem;
use Session;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    

    public function show()
    {
    	$paymentsInfo = SalaryInfo::where('status',0)->orderBy('paymentType_id', 'asc')->get();
        
    	return view('backEnd.salary.salarys', ['paymentsInfo'=>$paymentsInfo]);
    }

    public function paymentTypeByShow($paymentTypeId)
    {
        $paymentsInfo = SalaryInfo::where('status',0)->where('paymentType_id',$paymentTypeId)->get();
        return view('backEnd.salary.salarys', ['paymentsInfo'=>$paymentsInfo]);
    }

    public function paymentStore(Request $request)
    {
        $validation=Validator::make($request->all(), [
            'workerId' => 'required',
            'salary_id' => 'required',
            'amount' => 'required|integer'
            ]);

        if($validation->passes()){
            $paymentsInfo = SalaryInfo::where('id', $request->salary_id)->first();
            $payed_amount = $paymentsInfo->paymentHistory()->sum('amount') + $request->amount;

            if($paymentsInfo->totalSalary >= $payed_amount){
                $payment = new paymentHistory;
                $payment->workerId= $request->workerId;
                $payment->salary_id= $request->salary_id;
                $payment->amount= $request->amount;
                $payment->save();

                if($paymentsInfo->totalSalary <= $payed_amount){
                    $paymentsInfo->update(['status'=>1]);
                }

                Session::flash('success','Payment Amount Successfully Stored ');
                return redirect()->back();
            }
            Session::flash('warning','Payed Amount is not more than Total Salary Amount..!');
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors($validation);
        }
    }

    
   
}
