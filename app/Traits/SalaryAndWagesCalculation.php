<?php

namespace App\Traits;
use App\Attendance;
use App\WorkerPaymentInfo;
use App\SalaryInfo;

trait SalaryAndWagesCalculation
{

    private function SalaryAndWagesCalculate($workerId,$month=NULL,$year=NULL,$countAbleDates=NULL)
    {	

    	//Delcear total present and total overtiem hour and worker salaryOrwages array variable
        $present = 0; $total_overTime = 0; $salaryOrwages=array();
        
        //find the worker Payment Infomation where workerId is match
        $paymentInfo = WorkerPaymentInfo::where('workerId', $workerId)->first();


        //make a for loop and take all atandance  day by day
        for ($i=1; $i <=$countAbleDates; $i++) 
        {	
        	if($paymentInfo->paymentType == 1){
        		$atandance_date = date($year.'-'.$month.'-'.$i);
        	}elseif($paymentInfo->paymentType == 2){
        		$atandance_date =date("Y-m-d",strtotime("last saturday -1 week"." +".($i-1)." day"));
        		
        	}elseif($paymentInfo->paymentType == 3){
        		$atandance_date = date('Y-m-d',strtotime('-1 day'));
        	}

        	
            //get the working duration mint where date is match
            $duration_in_mint = Attendance::where('UserId', $workerId)->whereDate('AttendanceDate','=',$atandance_date)->value('Duration');

            //chacke is this day worker ar present or not 
            if(!empty($duration_in_mint) && !is_null($duration_in_mint))
            {
            	//working duration make houre from mint
            	$duration_in_hour = $duration_in_mint / 60;

                //time diffrance between time limit and duration

                $diffrance = $paymentInfo->timeLimit - $duration_in_hour;

                //compair with given working time and if is more than time than add it on overtme or just count a working day
                if ($diffrance <= 0.25) 
                {	
                	//round the working time duration
					$working_duration = round($duration_in_hour);

                    //count overtime working duration 
                    $per_day_overTime = $working_duration - $paymentInfo->timeLimit;

                    
                    //sum total overtime with over Time hour
                    $total_overTime = $total_overTime + $per_day_overTime;

                    //Count totalAttendance
                    $present++;

                 }
            }
        }

        
        //check worker payment method 1=>monthly , 2=>weekly , 3=>daily

        if($paymentInfo->paymentType == 1){
        	//add monthly payment worker data in the array
        	$salaryOrwages['present']= $present;
        	$salaryOrwages['overtime']= $total_overTime;
        	$salaryOrwages['overtimeSalary']= $total_overTime*$paymentInfo->overtimeAmount;
        	$salaryOrwages['basicSalary']= $paymentInfo->amount;
        	$salaryOrwages['salaryTo']= $year.'-'.$month.'-01';
        	$salaryOrwages['salaryFrom']= $year.'-'.$month.'-'.$countAbleDates;
        }elseif($paymentInfo->paymentType == 2){
        	//add weekly payment worker data in the array
        	$salaryOrwages['present']= $present;
        	$salaryOrwages['overtime']= $total_overTime;
        	$salaryOrwages['overtimeSalary']= $total_overTime*$paymentInfo->overtimeAmount;
        	$salaryOrwages['basicSalary']= $paymentInfo->amount;
        	$salaryOrwages['salaryTo']= date("Y-m-d",strtotime("last saturday -1 week"));
        	$salaryOrwages['salaryFrom']= date("Y-m-d",strtotime("last saturday"));
        	
        }elseif($paymentInfo->paymentType == 3){
        	//add weekly payment worker data in the array
        	$salaryOrwages['present']= $present;
        	$salaryOrwages['overtime']= $total_overTime;
        	$salaryOrwages['overtimeSalary']= $total_overTime*$paymentInfo->overtimeAmount;
        	$salaryOrwages['basicSalary']= $paymentInfo->amount;
        	$salaryOrwages['salaryTo']= date('Y-m-d',strtotime('-1 day'));
        	$salaryOrwages['salaryFrom']= date("Y-m-d");
        	
        }

        

        //store salary and wages information in salary info table
        if($salaryOrwages['present'] != 0){

	        $salaray_or_wages = new SalaryInfo;
	        $salaray_or_wages->workerId = $workerId;
	        $salaray_or_wages->paymentType_id = $paymentInfo->paymentType;
	        $salaray_or_wages->salaryTo = $salaryOrwages['salaryTo'];
	        $salaray_or_wages->salaryFrom = $salaryOrwages['salaryFrom'];
	        $salaray_or_wages->present = $salaryOrwages['present'];
	        $salaray_or_wages->overtime = $salaryOrwages['overtime'];
	        $salaray_or_wages->basicSalary = $salaryOrwages['basicSalary'];
	        $salaray_or_wages->overtimeSalary = $salaryOrwages['overtimeSalary'];
	        $salaray_or_wages->totalSalary = $salaryOrwages['basicSalary']+$salaryOrwages['overtimeSalary'];
	        $salaray_or_wages->status = 0;
	        $salaray_or_wages->save();
	    }
    }

}