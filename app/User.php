<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'extension1',
        'extension2',
        'extension3',
        'username',
        'password',
        'birthday',
        'bday_year',
        'anniversary',
        'anniv_year',
        'email',
        'telephone',
        'skype',
        'address',
        'state',
        'city',
        'zip',
        'country',
        'educ',
        'user_level',
        'sched_start',
        'sched_end',
        'sched_cat',
        'Four_D',
        'Four_D_status',
        'status',
        'contact_person',
        'contact_number',
        'email_or_call',
        'sales',
        'IfNotSalesWhy',
        'type',
        'updates',
        'FollowedUpOn',
        'service',
        'client_code',
        'rateperhour'
        
    ];

    public function messageclient(){
        return $this->hasMany('App\MessageClient');
    }

    public function contacts(){
        return $this->hasMany('App\Contact');
    }

    public function emails(){
        return $this->hasMany('App\Email');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function timedoctor(){
        return $this->hasMany('App\Timedoctor');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password){
        $this->attributes['password']=bcrypt($password);
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPasswordNotification($token));
    }
}
