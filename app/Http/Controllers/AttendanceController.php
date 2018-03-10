<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkarBasicInfo;
use App\Attend;


class AttendanceController extends Controller
{
    public function index()
    {	
    	
    	return view('backEnd.attendance.viewAttendanceForm');
    }


    
}
