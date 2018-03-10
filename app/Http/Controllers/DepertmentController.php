<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Depertment;

class DepertmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $depertments = Depertment::all();
        return view('backEnd.depertment.insertDepertmentContent',['depertments'=> $depertments]);
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
            //if validation pass Store data
            $depertment = new Depertment;
            $depertment->deptName = ucfirst($request->deptName);
            $depertment->deptCode = strtoupper($request->deptCode);
            $depertment->workingTime = $request->workingTime;
            $depertment->publicationStatus = $request->publicationStatus;
            $depertment->save();

            //redirect to the intendent location with Success message
            return redirect()->intended( route('depertment'))->with('success','Depertment Information Save SuccessFully !');   
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
        
        $depertmentById = Depertment::where('id', $id)->first();
        return view('backEnd.depertment.editDepertmentContent',['depertmentById'=>$depertmentById]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        //Validate the incomming data
        $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes()) {
            //if validation pass Update data
            $depertment = Depertment::find( $request->deptId);
            $depertment->deptName = ucfirst($request->deptName);
            $depertment->deptCode = strtoupper($request->deptCode);
            $depertment->workingTime = $request->workingTime;
            $depertment->publicationStatus = $request->publicationStatus;
            $depertment->save();

            return redirect()->route('depertment')->with('success', 'Update Depertment Information SuccessFully !');
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
        $depertment= Depertment::find($id);
        $depertment->delete();
        return redirect()->route('depertment')->with('success', 'Depertment Information Delete SuccessFully !');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function checkValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'deptName' => 'required',
            'deptCode' => 'required',
            'workingTime' => 'required|integer',
            'publicationStatus' => 'required|boolean',
            ]);
        //return report
        return $validation;
    }
}
