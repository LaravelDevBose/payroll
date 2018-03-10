<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depertment extends Model
{
    protected $fillable = [
        'deptName','deptCode','workingTime','publicationStatus'
    ];
}
