<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SalaryAndWagesCalculation;
require 'vendor/autoload.php';
use Carbon\Carbon;
use App\SalaryInfo;
use App\PaymentSystem;
use App\WorkarBasicInfo;
use App\WorkerPaymentInfo;
use DB;
use DateTime;


class HomeController extends Controller
{   

    use SalaryAndWagesCalculation;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->salaryCalculation();

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   


        $fringerPrintNullInfos =DB::table('workar_basic_infos')
                ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
                ->select('workar_basic_infos.*', 'depertments.deptName')
                ->where('workar_basic_infos.fringerPrint',Null)
                ->orderBy('id', 'asc')
                ->paginate(20);


        $datetime= Carbon::now();
        $today= $datetime->format('Y-m-d');
        $salaryAndWages = SalaryInfo::where('status',0)->orderBy('paymentType_id', 'desc')->get();
        $paymentTypes = PaymentSystem::where('status',1)->take(5)->get();
        return view('backEnd.dashboard.home', ['datetime'=>$datetime,'fringerPrintNullInfos'=>$fringerPrintNullInfos,
         'salaryAndWages'=>$salaryAndWages,'paymentTypes'=>$paymentTypes]);
    }


    private function salaryCalculation(){

        //create Date time for privious month and year
        
        $today= date('d');
        
        $previous_week = strtotime("-1 week");

        if(1<= $today && $today <= 7){
            $month = date('m');
            $year = date('Y');
            $previousMonth = $month-1; //privious month
            $previousMonth = ($previousMonth == 0) ? '12' : $previousMonth; //if is Zero than it make 12 of privious month
            $year = ($previousMonth == 12) ? $year-1 : $year;  //make yer is this month is first of this yr than make it of last yr
            $previous_month_total_days = cal_days_in_month(CAL_GREGORIAN, $previousMonth, $year); //count total dayes of last month

            
            $this->monthlyPaymentCount($today,$previousMonth, $year, $previous_month_total_days);
        }

        if($today = date('d',strtotime("last saturday"))){
            $this->weeklyPaymentCount();
        }

        $this->dailyPaymentCount();


    }

    private function monthlyPaymentCount($today,$previousMonth,$year,$previous_month_total_days){
        
        $last_month_year = $year.'-'.$previousMonth;   
        //get all worker info who is monthly pated
        $workerInfo = DB::table('workar_basic_infos')
                    ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
                    ->where('worker_payment_infos.paymentType',1)
                    ->whereMonth('workar_basic_infos.created_at', '<=', $previousMonth)
                    ->whereYear('workar_basic_infos.created_at', '<=', date('Y'))
                    ->select('workar_basic_infos.*')->get();

                    
        //make a foreach loop then one by one chack attendes and worker time
        foreach ($workerInfo as $wokerInfo)
        {
            //check is this worker salary/wages already count or not

            $salery_wages_check = SalaryInfo::where('workerId', $wokerInfo->id)->whereDate('salaryTo','=',date($last_month_year.'-01'))
                                        ->whereDate('salaryFrom','=',date($last_month_year.'-'.$previous_month_total_days))->first();

            //check salary or wagies allready store or not
            if (is_null($salery_wages_check) || empty($salery_wages_check))
            { 
                //store and calculate worker salary and wagies
                $this->SalaryAndWagesCalculate($wokerInfo->id,$previousMonth,$year,$previous_month_total_days);
                
            }  
        }
    }

    private function weeklyPaymentCount(){

        //make the date for privious week saturday for check
        $last_saturday = date("Y-m-d",strtotime("last saturday"));  
        //get all worker info who is monthly pated
        $workerInfo = DB::table('workar_basic_infos')
                    ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
                    ->where('worker_payment_infos.paymentType',2)
                    ->whereDate('workar_basic_infos.created_at', '<=',$last_saturday)
                    ->select('workar_basic_infos.*')->get();
        
        //make a foreach loop then one by one chack attendes and worker time
        foreach ($workerInfo as $wokerInfo)
        {
            //check is this worker salary/wages already count or not
            $prv_saturday = date("Y-m-d",strtotime("last saturday -1 week"));
            $salery_wages_check = SalaryInfo::where('workerId', $wokerInfo->id)->whereDate('salaryTo','=',$prv_saturday)
                                        ->whereDate('salaryFrom','=',$last_saturday)->first();

            //check salary or wagies allready store or not
            if (is_null($salery_wages_check) || empty($salery_wages_check))
            { 
                //store and calculate worker salary and wagies
                $this->SalaryAndWagesCalculate($wokerInfo->id,Null,NuLL,7);
                
            }
            
        }
        return;
    }

    private function dailyPaymentCount(){

          
        //get all worker info who is monthly pated
        $workerInfo = DB::table('workar_basic_infos')
                    ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
                    ->where('worker_payment_infos.paymentType',3)
                    ->whereDate('workar_basic_infos.created_at', '<',date("Y-m-d"))
                    ->select('workar_basic_infos.*')->get();
        
        //make a foreach loop then one by one chack attendes and worker time
        foreach ($workerInfo as $wokerInfo)
        {
            //check is this worker salary/wages already count or not
            $prv_saturday = date("Y-m-d",strtotime("last saturday -1 week"));
            $salery_wages_check = SalaryInfo::where('workerId', $wokerInfo->id)->whereDate('salaryTo','=',date("Y-m-d",strtotime("-1 day")))
                                        ->whereDate('salaryFrom','=',date("Y-m-d"))->first();

            //check salary or wagies allready store or not
            if (is_null($salery_wages_check) || empty($salery_wages_check))
            { 
                //store and calculate worker salary and wagies
                $this->SalaryAndWagesCalculate($wokerInfo->id,Null,NuLL,1);
                
            }
            
        }
        return;
    }


}
