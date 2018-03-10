<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkarBasicInfo;
use App\PaymentHistory;
use App\SalaryInfo;
use DB;
use Session;

class SingelWorkerController extends Controller
{	

  
    public function profile($id)
    {   	
    	$singelworker = DB::table('workar_basic_infos')
            ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
            ->join('worker_details_infos', 'workar_basic_infos.id', '=', 'worker_details_infos.workerId')
            ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
            ->select('workar_basic_infos.*', 'worker_details_infos.*', 'worker_payment_infos.*' , 'depertments.deptName')
            ->where('workar_basic_infos.id', $id)
            ->first();

           
        return view('backEnd.worker.singelWorker.singelWorkerProfile', ['singelworker'=>$singelworker,'id'=>$id]);
    }

    public function attendes($id ,$month, $year ){


    	$singelworker = DB::table('workar_basic_infos')
                ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
                ->select('workar_basic_infos.*', 'depertments.deptName')
                ->where('workar_basic_infos.id', $id)
                ->first();

        $start_day_of_week = 0 ;
    	$totalWeeks = $this->weeks_in_month($year, $month, $start_day_of_week);

  

    	return view('backEnd.worker.singelWorker.singelWorkerAttendes', ['id'=>$id,'singelworker'=>$singelworker, 'month'=>$month,'year'=>$year,'totalWeeks'=>$totalWeeks]);
    }

    /**
   * Return the total number of weeks of a given month.
   * @param int $year
   * @param int $month
   * @param int $start_day_of_week (0=Sunday ... 6=Saturday)
   * @return int
   */
    private function weeks_in_month($year, $month, $start_day_of_week)
    {
        // Total number of days in the given month.
        $num_of_days = date("t", mktime(0,0,0,$month,1,$year));
     
        // Count the number of times it hits $start_day_of_week.
        $num_of_weeks = 0;
        for($i=1; $i<=$num_of_days; $i++)
        {
          $day_of_week = date('w', mktime(0,0,0,$month,$i,$year));
          if($day_of_week==$start_day_of_week)
            $num_of_weeks++;
        }
     
        return $num_of_weeks;
    }

    public function paymentDetails($id){
      	$singelworker = DB::table('workar_basic_infos')
                ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
                ->select('workar_basic_infos.name','workar_basic_infos.image', 'depertments.deptName')
                ->where('workar_basic_infos.id', $id)
                ->first();

        $workerPayment = WorkarBasicInfo::where('id',$id)->firstOrFail();

        return view('backEnd.worker.singelWorker.singelWorkerPayment', ['id'=>$id,'singelworker'=>$singelworker,'workerPayment'=>$workerPayment]);
    }

    

}
