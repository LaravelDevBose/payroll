<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\PaymentSystem;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $paymentsInfo = PaymentSystem::all();
        $paymentSystem_ids = $paymentsInfo->pluck('id')->toArray();
        
        if(is_null($paymentsInfo) || !in_array(1 ,$paymentSystem_ids) || !in_array(2 ,$paymentSystem_ids) || !in_array(3,$paymentSystem_ids)){

            $this->default_paymentSystem();
        }
        return view('backEnd.paymentSystem.insertPaymentContent',['paymentsInfo'=> $paymentsInfo]);
        // return view('backEnd.payment.insertPaymentContent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        
        //Validate the incomming data
        $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes()) {
            $total = PaymentSystem::count();
            //if validation pass Store data
            $paymentSystem = new PaymentSystem;
            $paymentSystem->id = $total+1; 
            $paymentSystem->paymentTitle = $request->paymentTitle;
            $paymentSystem->duration = $request->duration;
            $paymentSystem->unit = $request->unit;
            $paymentSystem->status = $request->status;
            $paymentSystem->save();

            //redirect to the intendent location with Success message
            return redirect()->intended( route('paymentSystem'))->with('success','Payment System Information Save SuccessFully !');
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        
        if($id <=3){return redirect()->route('paymentSystem')->with('warning', 'This Payment System Information not Editable.!');}
        $paymentSystemById = PaymentSystem::findOrFail($id);
        return view('backEnd.paymentSystem.editPaymentContent',['paymentSystemById'=>$paymentSystemById]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        if($request->paymentId <=3){return redirect()->route('paymentSystem')->with('warning', 'This Payment System Information not Editable.!');}
        //Validate the incomming data
        $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes()) {
            //if validation pass Update data
            $paymentSystem = PaymentSystem::find( $request->paymentId);
            $paymentSystem->paymentTitle = $request->paymentTitle;
            $paymentSystem->duration = $request->duration;
            $paymentSystem->unit = $request->unit;
            $paymentSystem->status = $request->status;
            $paymentSystem->save();

            return redirect()->route('paymentSystem')->with('success', 'Update payment System Information SuccessFully !');
        }else{
                //if Validation not pass/fails backe to the page with old data 
                //also with error message
                return redirect()->back()
                        ->withErrors($validationReport)
                        ->withInput( $request->all());
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        if($id <=3){return redirect()->route('paymentSystem')->with('warning', 'This Payment System Information not Deleteable.!');}
        $paymentSystem= PaymentSystem::find($id);

        if($paymentSystem->worker->count() == 0){
            $paymentSystem->delete();
            return redirect()->route('paymentSystem')->with('success', 'Payment System Information Delete SuccessFully !');
        }
            return redirect()->back()->with('warning', 'Some Workers are also include in this Payment System. First Change Them.');
        

    }


     private function default_paymentSystem(){

        PaymentSystem::updateOrCreate(['id'=>1],['id'=>1,'paymentTitle'=>'Monthly', 'duration'=>1,'unit'=>3,'status'=>1, 'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
        PaymentSystem::updateOrCreate(['id'=>2],['id'=>2,'paymentTitle'=>'Weekly', 'duration'=>7,'unit'=>2,'status'=>1, 'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
        PaymentSystem::updateOrCreate(['id'=>3],['id'=>3,'paymentTitle'=>'Daily', 'duration'=>1,'unit'=>2,'status'=>1, 'created_at'=>date('Y-m-d h:i:s'),'updated_at'=>date('Y-m-d h:i:s')]);
        return ;
     }


    /**
     * Remove the specified resource from storage.
     */
    public function checkValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'paymentTitle' => 'required',
            'duration' => 'required|integer',
            'unit' => 'required|integer',
            'status' => 'required|boolean',
            ]);
        //return report
        return $validation;
    }
}
