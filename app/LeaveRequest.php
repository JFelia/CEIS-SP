<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
    	'user_id',
     	'request',
        'start_date',
    	'end_date', //to get the sender name
        'remarks'
    ];
}
