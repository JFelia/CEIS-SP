<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Getintouch extends Model
{
    protected $fillable = [
    	"fullname",
    	"email",
    	"message"
    ];
}
