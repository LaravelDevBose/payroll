<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerDetailsInfo extends Model
{
    protected $fillable = [
        'workarTableId','nationalId','phoneNo','email',
        'preHouseNo', 'preRoadNo','preVillage','preP_O','preP_S','preP_C','preDistrict','preCountry',
        'parHouseNo','parRoadNo','parVillage','parP_O','parP_S','parP_C','parDistrict','parCountry',
        
    ];
}
