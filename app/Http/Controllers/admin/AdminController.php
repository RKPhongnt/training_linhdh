<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class AdminController extends Controller
{
    //
    public function __construct()
    {   
    	$this->middleware('admin');    
    }
}
