<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * check admin
    */
    public function isAdmin()
    {
        return $this->isAdmin;
    }
    /*
    * return list division that user manage
    */ 
    public function divisions()
    {
        return $this->hasMany('App\Division','manager_id');
    }

    /*
    *return division this user belong to
    */ 
    public function belongDivision()
    {
        return $this->belongsTo('App\Division','devision_id');
    }

    /*
    * check is actived account
    */ 
    public function isActive()
    {
        return $this->isActive;
    }

    /*
    * reset password
    */ 
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /*
    * check current user
    */ 
    public function is_current_user($user)
    {
        return Auth::user()->id == $user->id;
    }
}
