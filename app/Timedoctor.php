<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timedoctor extends Model
{
    //
    protected $fillable = [
    	'user_id', //to get the sender name
        'sched_start',
        'sched_end',
    	'am_time_in',
        'am_time_out',
        'pm_time_in',
        'pm_time_out',
    	'date',
        'month_year',
        'day',
        'remarks', //to know if overtime or undertime or absent or leave
    	'status',
        'identifier'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
