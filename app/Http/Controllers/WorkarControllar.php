<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Depertment;
use App\WorkarBasicInfo;
use App\WorkerDetailsInfo;
use App\WorkerPaymentInfo;
use App\PaymentSystem;
use Session;
use DB;

class WorkarControllar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $depertments= Depertment::where('publicationStatus', 1)->select('id','deptName')->get();
    	$paymentSystems= PaymentSystem::where('status', 1)->select('id', 'paymentTitle')->get();
        return view('backEnd.worker.insertWorkerInfo',['depertments'=>$depertments, 'paymentSystems'=>$paymentSystems]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        // var_dump($request->all());
        
        //Validate the incomming data
        $validationReport = $this->checkValidateData( $request );

        if ($validationReport->passes() ) {
            //if validation pass,than chack image validation
            $imageInfo=$request->file('image');

            $imageVallidation=$this->checkImageValidaction( $imageInfo);
            
            if (is_null( $imageVallidation )) {
                //if image validation Pass than Uplode image
                    $imageUrl = $this->moveUplodeImage( $imageInfo);

                //save Date in worker basic Info Table and take save worker basic table table Id in variable
                    $tableId=$this->basicInfoStore( $request , $imageUrl);

                //take depertment Code from depertment table by depertment id
                    $deptCode= Depertment::where('id', $request->depertmentId )->value('deptCode');

                //make a worker id with depertment code+worker table id
                    $this->workerIdStore($tableId, $deptCode);

                //than Save data in workerdetailes table And worker Payment Table 
                    $this->detailesInfoStore( $tableId, $request);

                    $this->paymentInfoStore( $tableId, $request);
                Session::flash('success', 'Employee Information Inserted SuccessFully. Use '.$tableId.'as Id When Insert FingerPrint In Machine For '.$request->name.' Worker');
                //redirect to the intendent location with Success message
                return redirect()->route('worker');
            } else {
                //if fvalidation fails than redirect back with input and massage
                return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Use Valid Image Formate And size !');
            }
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
 
    }

    /**
     * Store a newly created worker basic Information in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function basicInfoStore( $request, $imageUrl){

        //storing basicInfomation table 

        $workerInfo = new WorkarBasicInfo;
        $workerInfo->name = ucfirst($request->name);
        $workerInfo->gender = $request->gender;
        $workerInfo->depertmentId = $request->depertmentId;
        $workerInfo->image = $imageUrl;
        $workerInfo->save();

        //return worker table id
        return $tableId= $workerInfo->id;
    }

    /**
     * Store a newly created worker Id in basic table storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function workerIdStore( $tableId, $deptCode){
        
        //check $tableId value
       if ($tableId > 99) {
            //if is gatter then 99 than concrite just table number
            $workerId = $deptCode.$tableId;
           
       } 
        elseif ($tableId >9) {
            //if its gatter then 9 than contrict one zero in medill 
            $workerId = $deptCode.'0'.$tableId;
        }
       else {
            //Other wish concreate two zero in middel
            $workerId = $deptCode.'00'.$tableId;
       }
        $workerInfo= WorkarBasicInfo::find( $tableId );
        $workerInfo->workerViewId = $workerId;
        $workerInfo->save();
       
    }

    /**
     * Store a newly created worker Detailes Information in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function detailesInfoStore( $tableId, $request){

        $workerInfo = new WorkerDetailsInfo;
        $workerInfo->workerId = $tableId ;
        $workerInfo->nationalId = $request->nationalId;
        $workerInfo->phoneNo = $request->phoneNo;
        $workerInfo->email = $request->email;
        //present Address Information
        $workerInfo->preHouseNo = $request->preHouseNo;
        $workerInfo->preRoadNo = $request->preRoadNo;
        $workerInfo->preVillage = $request->preVillage;
        $workerInfo->preP_O = $request->preP_O;
        $workerInfo->preP_S = $request->preP_S;
        $workerInfo->preP_C = $request->preP_C;
        $workerInfo->preDistrict = $request->preDistrict;
        $workerInfo->preCountry = $request->preCountry;
        //parmanent Address Information
        $workerInfo->parHouseNo = $request->parHouseNo;
        $workerInfo->parRoadNo = $request->parRoadNo;
        $workerInfo->parVillage = $request->parVillage;
        $workerInfo->parP_O = $request->parP_O;
        $workerInfo->parP_S = $request->parP_S;
        $workerInfo->parP_C = $request->parP_C;
        $workerInfo->parDistrict = $request->parDistrict;
        $workerInfo->parCountry = $request->parCountry;
        $workerInfo->save();
    }

    /**
     * Store a newly created worker Payment Information in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function paymentInfoStore( $tableId, $request){
        
        $workerInfo = new WorkerPaymentInfo;
        $workerInfo->workerId = $tableId;
        $workerInfo->paymentType = $request->paymentType;
        $workerInfo->amount = $request->ammount;
        $workerInfo->timeLimit = $request->timeLimit;
        $workerInfo->save();
    }



    /**
     * Display the All Worker Information resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(){
        
        $workersInfo =DB::table('workar_basic_infos')
                ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
                ->join('worker_details_infos', 'workar_basic_infos.id', '=', 'worker_details_infos.workerId')
                ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
                ->join('payment_systems', 'worker_payment_infos.paymentType', '=', 'payment_systems.id')
                ->select('workar_basic_infos.*', 'depertments.deptName', 'worker_details_infos.phoneNo','payment_systems.paymentTitle', 'worker_payment_infos.amount','worker_payment_infos.timeLimit' )
                ->orderBy('id', 'desc')
                ->get();

        return view('backEnd.worker.showWorkerInfoContent',['workersInfo'=>$workersInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $depertments= Depertment::where('publicationStatus', 1)->select('id','deptName')->get();
        $paymentSystems= PaymentSystem::where('status', 1)->select('id', 'paymentTitle')->get();
        
        $workerById =DB::table('workar_basic_infos')
                ->join('depertments', 'workar_basic_infos.depertmentId', '=', 'depertments.id')
                ->join('worker_details_infos', 'workar_basic_infos.id', '=', 'worker_details_infos.workerId')
                ->join('worker_payment_infos', 'workar_basic_infos.id', '=', 'worker_payment_infos.workerId')
                ->join('payment_systems', 'worker_payment_infos.paymentType', '=', 'payment_systems.id')
                ->select('workar_basic_infos.*', 'depertments.*', 'worker_details_infos.*','worker_payment_infos.*','payment_systems.*')
                ->where('workar_basic_infos.id', $id)
                ->first();

        return view('backEnd.worker.editWorkerInfo', ['id'=>$id, 'depertments'=>$depertments, 'paymentSystems'=>$paymentSystems, 'workerById'=>$workerById ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Validate the incomming data
        $validationReport = $this->updateCheckValidateData( $request );

        if ($validationReport->passes() ) {
            //if validation pass,than chack image validation
            $imageUrl=$this->uplodeNewImage( $request);
            
            if (!is_null( $imageUrl )) {
                //if image validation Pass than Uplode image
                   

                //save Date in worker basic Info Table and take save worker basic table table Id in variable
                    $tableId=$this->basicInfoUpdate( $request , $imageUrl);


                //take depertment Code from depertment table by depertment id
                    $deptCode= Depertment::where('id', $request->depertmentId )->value('deptCode');

                //make a worker id with depertment code+worker table id
                    $this->workerIdStore($tableId, $deptCode);

                //than Save data in workerdetailes table And worker Payment Table 
                    $this->detailesInfoUpdate( $tableId, $request);

                    $this->paymentInfoUpdate( $tableId, $request);

                    Session::flash('success', 'Employee Information Inserted SuccessFully. Use '.$tableId.' as Id When Insert FingerPrint In Machine For '.$request->name.' Employee');
                //redirect to the intendent location with Success message
                return redirect()->back();
            } else {
                //if fvalidation fails than redirect back with input and massage
                return redirect()->back()->withInput( $request->all())->with('unsuccess', 'Use Valid Image Format And size !');
            }
        }else{
            //if Validation not pass/fails backe to the page with old data 
            //also with error message
            return redirect()->back()
                    ->withErrors($validationReport)
                    ->withInput( $request->all());
        }
    }


    protected function basicInfoUpdate($request, $imageUrl)
    {
        //storing basicInfomation table 

        $workerInfo = WorkarBasicInfo::find($request->workerEditId);
        $workerInfo->name = ucfirst($request->name);
        $workerInfo->gender = $request->gender;
        $workerInfo->depertmentId = $request->depertmentId;
        $workerInfo->image = $imageUrl;
        $workerInfo->save();

        //return worker table id
        return $tableId= $workerInfo->id;
    }

    protected function detailesInfoUpdate( $tableId, $request)
    {   
        $data=[
        'nationalId' => $request->nationalId,
        'phoneNo' => $request->phoneNo,
        'email' => $request->email,
        //present Address Information
        'preHouseNo' => $request->preHouseNo,
        'preRoadNo' => $request->preRoadNo,
        'preVillage' => $request->preVillage,
        'preP_O' => $request->preP_O,
        'preP_S' => $request->preP_S,
        'preP_C' => $request->preP_C,
        'preDistrict' => $request->preDistrict,
        'preCountry' => $request->preCountry,
        //parmanent Address Information
        'parHouseNo' => $request->parHouseNo,
        'parRoadNo' => $request->parRoadNo,
        'parVillage' => $request->parVillage,
        'parP_O' => $request->parP_O,
        'parP_S' => $request->parP_S,
        'parP_C' => $request->parP_C,
        'parDistrict' => $request->parDistrict,
        'parCountry' => $request->parCountry,

         ];
        DB::table('worker_details_infos')->where('workerId',$tableId)
                ->update($data);
        
    }

    protected function paymentInfoUpdate( $tableId, $request)
    {   

        $data = [
            'paymentType' => $request->paymentType,
            'amount' => $request->ammount,
            'timeLimit' => $request->timeLimit,
        ];

        DB::table('worker_payment_infos')->where('workerId',$tableId)->update($data);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function checkValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required|boolean',
            'depertmentId'=>'required|integer',
            'image'=>'required|image',
            'nationalId'=>'required',
            'phoneNo'=>'required',
            //prenset Address
            'preP_O'=>'required',
            'preP_S'=>'required',
            'preP_C'=>'required',
            'preDistrict'=>'required',
            'preCountry'=>'required',
            //parmanet Address
            'parP_O'=>'required',
            'parP_S'=>'required',
            'parP_C'=>'required',
            'parDistrict'=>'required',
            'parCountry'=>'required',
            'paymentType'=>'required|integer',
            'ammount'=>'required|integer',
            'timeLimit'=>'required|integer',
            ]);
        //return report
        return $validation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateCheckValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required|boolean',
            'depertmentId'=>'required|integer',
            'nationalId'=>'required',
            'phoneNo'=>'required',
            //prenset Address
            'preP_O'=>'required',
            'preP_S'=>'required',
            'preP_C'=>'required',
            'preDistrict'=>'required',
            'preCountry'=>'required',
            //parmanet Address
            'parP_O'=>'required',
            'parP_S'=>'required',
            'parP_C'=>'required',
            'parDistrict'=>'required',
            'parCountry'=>'required',
            'paymentType'=>'required|integer',
            'ammount'=>'required|integer',
            'timeLimit'=>'required|integer',
            ]);
        //return report
        return $validation;
    }

    private function checkImageValidaction($imageInfos){
        //check Image File type 
        $this->checkFileType($imageInfos);
    }

    private function checkFileType($imageInfos){
        //get file type form imageInfos 
        $FileType = $imageInfos->getClientMimeType();

        //check Images file type
        if($FileType){

             //If pass then Forward to checkFileExtention function
            $this->checkFileExtention($imageInfos);

        }else{
             //If fails return back with status messages
            return redirect()->route('worker')->with('unsuccess', 'valid Image File !');
        }
     
    }

    private function checkFileExtention($imageInfos){

        //get imageExtention form imageInfos
        $imageExtention =$imageInfos->getClientOriginalExtension();

        //check image jpg or png...
        if($imageExtention =='jpg'|| $imageExtention =='png'){
           
            //If image is png or jpg then Forward to checkImageSize function
            $this->checkImageSize($imageInfos);
        }else{
            
        //If image not jpg or png then back to previous page with status message
        return redirect()->route('worker')->with('unsuccess', ' Use jpg or png Image File');
        }
        
    }

    private function checkImageSize($imageInfos){
        //get image Size 
        $imageSize = filesize($imageInfos);

        //Check Image Size is it getter then 50000 bit or not
        if($imageSize > 1700000){
            
             //If imageSize is getter then 50000 bit then back to Previous page with status message 
        return redirect()->route('worker')->with('unsuccess', 'Image  are too large File');
        }

    }

    private function moveUplodeImage($imageInfos){
        //Get Image name
        $imageName =$imageInfos->getClientOriginalName();

        //Define Uplode path 
        $uploadPath = 'public/images/worker/';

        //move to Define folder
        $imageInfos->move($uploadPath, $imageName);

        //return totel url to join uplodepath and imageName
        return $imageUrl = $uploadPath . $imageName;

    }

    private function uplodeNewImage($request){

        //get Previous Image Information (must be change model name and colame Id)
        $imageinfoById = WorkarBasicInfo::find($request->workerEditId);

        //check has new file or not  ...? If has new file the Enter into If Condition
        if($request->hasFile('image')){
            //Get all Infomation About new image
            $newimageInfos=$request->file('image');

            //check Images validation If pass Validation go forward
            if(!$this->checkImageValidaction($newimageInfos)){

                //Distroy Previous Image
                $destryOldImage = $this->destroyPvesImage($imageinfoById);

                //check can Destroy Previous or not
                if(!$destryOldImage){

                    //If Destroy Previous images then move to folder call moveUplodeImages function
                    $imageUrl= $this->moveUplodeImage($newimageInfos);
                }else{
                    //If Can not delete Image then back to previous page with message
                    return redirect()->back()->with('message', 'Can Not Delete Previous Images !');
                }
            }
        }
        //If has no new file then Enter into Else Condition
        else{
            //get previous image url 
            $imageUrl= $imageinfoById->image;
        }

        //return Images url 
        return $imageUrl;

    }

    private function destroyPvesImage($imageinfoById){
        //Destroy Image
        unlink($imageinfoById->image);
    }
}
