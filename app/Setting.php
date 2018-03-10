<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['setting_name', 'setting_one', 'setting_two','setting_three','setting_four','setting_five'];
}
