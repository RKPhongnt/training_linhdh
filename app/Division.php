<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Division extends Model
{
    //
    protected $fillable = ['name', 'manager_id'];

    public function manager()
    {
    	return $this->belongsTo('App\User','manager_id');
    }

    public function staffs()
    {
    	return $this->hasMany('App\User','devision_id');
    }
}
