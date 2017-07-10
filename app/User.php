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

    public function divisions()
    {
        return $this->hasMany('App\Division','manager_id');
    }

    public function belongDivision()
    {
        return $this->belongsTo('App\Division','devision_id');
    }
}
