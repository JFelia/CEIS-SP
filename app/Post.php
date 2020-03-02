<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
    	'user_id', //to get the sender name
        'message',
        'avatar',
        'remarks'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }
}
