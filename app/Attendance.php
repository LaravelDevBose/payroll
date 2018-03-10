<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{	
	protected $table = 'attendance';

    protected $fillable = [
        'UserId','DeviceId','AttendanceDate','InTime','OutTime','Duration','CreateDate'
    ];
}
