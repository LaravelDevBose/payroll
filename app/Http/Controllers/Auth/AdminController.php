<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Role;
use Session;
use Auth;
use DB;
class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration , Edit , Update And Ruls of new Admnis as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        if(Role::count() <17){
            $this->role_set_up();
        }
    }

    

    public function index(){
        $admins = User::all();
        return view('backEnd.admin.subAdmin.showAdminContent',['admins'=>$admins]);
    }

    public function create()
    {   
        $roles = Role::all();
        if($roles->count() <=0 ){
            Session::flash('warning','No Roles Found For Admin. Add Role First .!');
            return redirect()->back();
        }

        return view('backEnd.admin.subAdmin.insertAdminContent',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $report = $this->checkValidateData($request);
        if($report->passes())
        {   
            $imageUrl = NULL;;

            if($request->hasFile('avater')){
                $imageInfo=$request->file('avater');

                $imageVallidation=$this->checkImageValidaction( $imageInfo);

                if (is_null( $imageVallidation )) {
                //if image validation Pass than Uplode image
                    $imageUrl = $this->moveUplodeImage( $imageInfo);
                }else{
                    Session::flash('warning','Use Valid Image File.!');
                    return redirect()->back();
                }
            }

            $admin = new  User;
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->phone_number;
            $admin->status = $request->status;
            $admin->avater = $imageUrl;
            $admin->password = bcrypt($request->password);
            $admin->save();
            
            //set all Role for admin
            $role_ids = $request->role_id;
            for ($i=0; $i < count($role_ids) ; $i++) { 
                DB::table('role_user')->insert(['user_id'=>$admin->id , 'role_id'=>$role_ids[$i]]);
            }

            Session::flash('success','New Admnin Information Created SuccessFully.!');
            return redirect()->route('admin.index');
        }
        return redirect()->back()->withErrors($report)->withInput();
    }

    public function show($id){
       $adminById = User::find($id);
        $adminRoles = $adminById->roles()->pluck('role_id')->toArray();
        $roles = Role::all();
        return view('backEnd.admin.subAdmin.singelAdminContent',['adminById'=>$adminById, 'adminRoles'=>$adminRoles,'roles'=>$roles]);
    }

    public function edit($id){
        $adminById = User::find($id);
        $adminRoles = $adminById->roles()->pluck('role_id')->toArray();
        $roles = Role::all();
        return view('backEnd.admin.subAdmin.editAdminContent',['adminById'=>$adminById, 'adminRoles'=>$adminRoles,'roles'=>$roles]);
    }

    public function update(Request $request, $id)
    {   

       
        $report = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required',
            'status' => 'required',
            'role_id' => 'required',
            ]);
        if($report->passes())
        {   
            $imageUrl = User::where('id', $id)->value('avater');

            if($request->hasFile('avater')){
                $imageInfo=$request->file('avater');

                $imageVallidation=$this->checkImageValidaction( $imageInfo);

                if (is_null( $imageVallidation )) {
                //if image validation Pass than Uplode image
                    $imageUrl = $this->moveUplodeImage( $imageInfo);
                }else{
                    Session::flash('warning','Use Valid Image File.!');
                    return redirect()->back();
                }
            }
            
            $admin = User::find($id);
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->phone_number;
            $admin->status = $request->status;
            $admin->avater = $imageUrl;
            $admin->password = bcrypt($request->password);
            $admin->save();
            

            //set all Role for admin
            $role_ids = $request->role_id;

            for ($i=1; $i <= 18 ; $i++) { 

                
                $role = DB::table('role_user')->where('user_id', $id)->where('role_id', $i)->first();

                if(empty($role) && in_array($i, $role_ids) ){
                    DB::table('role_user')->insert(['user_id'=>$id , 'role_id'=>$i]);

                }elseif(!empty($role) && !in_array($i, $role_ids)){

                    DB::table('role_user')->where('id',$role->id)->delete();
                }
            }

            Session::flash('success','Admnin Information Updated SuccessFully.!');
            return redirect()->route('admin.index');
        }
        return redirect()->back()->withErrors($report);
    }

    public function destroy($id)
    {   
        if(Auth::user()->id == $id){

            Session::flash('warning','You Can Not Delete Your Own Account.');
            return redirect()->back();

        }else{

            $adminDelete = User::find($id);
            if(file_exists($adminDelete->avater)){
                unlink($adminDelete->avater);
            }
            $adminDelete->delete();

            for ($i=1; $i <= 18 ; $i++) { 

                $role = DB::table('role_user')->where('user_id', $id)->where('role_id', $i)->delete();
            }
            Session::flash('success','Admine Account Delete SuccessFully.');
            return redirect()->back();
        }
    }

    public function accountEditForm($id)
    {   
        $adminById = User::find($id);
        $adminRoles = $adminById->roles()->pluck('role_id')->toArray();
        $roles = Role::all();
        return view('backEnd.admin.subAdmin.editOwnAccountContent',['adminById'=>$adminById, 'adminRoles'=>$adminRoles,'roles'=>$roles]);
    }

    public function editOwnAccount(Request $request, $id){

        
         $report = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required',
            ]);
        if($report->passes())
        {   
            $imageUrl = User::where('id', $id)->value('avater');

            if($request->hasFile('avater')){
                $imageInfo=$request->file('avater');

                $imageVallidation=$this->checkImageValidaction( $imageInfo);

                if (is_null( $imageVallidation )) {
                //if image validation Pass than Uplode image
                    $imageUrl = $this->moveUplodeImage( $imageInfo);
                }else{
                    Session::flash('warning','Use Valid Image File.!');
                    return redirect()->back();
                }
            }
            
            $admin = User::find($id);
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->phone_number;
            $admin->avater = $imageUrl;
            $admin->password = bcrypt($request->password);
            $admin->save();
            


            //set all Role for admin
            $role_ids = $request->role_id;

            if(count($role_ids) > 0 ){
                for ($i=1; $i <= 18 ; $i++) { 
                
                    $role = DB::table('role_user')->where('user_id', $id)->where('role_id', $i)->first();

                    if(empty($role) && in_array($i, $role_ids) ){
                        DB::table('role_user')->insert(['user_id'=>$id , 'role_id'=>$i]);

                    }elseif(!empty($role) && !in_array($i, $role_ids)){

                        DB::table('role_user')->where('id',$role->id)->delete();
                    }
                }
            }
            

            Session::flash('success','Information Updated SuccessFully.!');
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors($report);

    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function checkValidateData($request){
        // create roles
        $validation=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'status' => 'required',
            'password' => 'required|string|min:6|confirmed',
            ]);
        //return report
        return $validation;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createAdmin(array $data, $imageUrl)
    {
        return User::create([
            'name' => $data['name'],
            'username'=>$data['username'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'avater' => $imageUrl,
            'status' => $data['status'],
            'role_id' => 'required',
            'password' => bcrypt($data['password']),
        ]);
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
            return redirect()->route('admin.index')->with('unsuccess', 'valid Image File !');
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
        return redirect()->route('admin.index')->with('unsuccess', ' Use jpg or png Image File');
        }
        
    }

    private function checkImageSize($imageInfos){
        //get image Size 
        $imageSize = filesize($imageInfos);

        //Check Image Size is it getter then 50000 bit or not
        if($imageSize > 1700000){
            
             //If imageSize is getter then 50000 bit then back to Previous page with status message 
        return redirect()->route('admin.index')->with('unsuccess', 'Image  are too large File');
        }

    }

    private function moveUplodeImage($imageInfos){
        //Get Image name
        $imageName =$imageInfos->getClientOriginalName();

        //Define Uplode path 
        $uploadPath = 'public/images/admin/';

        //move to Define folder
        $imageInfos->move($uploadPath, $imageName);

        //return totel url to join uplodepath and imageName
        return $imageUrl = $uploadPath . $imageName;

    }

    protected function role_set_up(){
        $default_roles =[
            '1'=>'Add Admin',
            '2'=>'Edit & Update Admin Info',
            '3'=>'Delete Admin Info',

            '4'=>'Add Depertment',
            '5'=>'Edit & Update Depertment Info',
            '6'=>'Delete Depertment Info',

            '7'=>'Add Atandance Type',
            '8'=>'Edit & Update Atandance Type Info',
            '9'=>'Delete Atandance Type Info',

            '10'=>'Add Worker Info',
            '11'=>'Edit & Update Worker Info',
            '12'=>'Delete Worker Info',

            '13'=>'Show Salary & Wages',
            '14'=>'Payment Salary & Wages',
            '15'=>'Calculate Salary & Wages',

            '16'=>'Insert Worker Atandance',

            '17'=>'Change Account Setting',
            '18'=>'Change RoleSetting'
        ];

        for ($i=1; $i <=count($default_roles) ; $i++) { 
            
            $set_role = Role::updateOrCreate(['id'=>$i , 'role_name'=>$default_roles[$i]]);
        }
        return ;
    }
}
