<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sched extends Model
{
    //
    protected $fillable = [
    	'category_name',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'working_days',
        'day_off',
        'type',
        'status'
    ];
}
