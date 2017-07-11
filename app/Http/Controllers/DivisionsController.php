<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Division;
use App\User;
class DivisionsController extends Controller
{
	/**
	* display divisions user manage
	*/
    public function index()
    {	
    	$divisions = Auth::user()->divisions ;
    	return view('division.index',['divisions'=>$divisions]);
    }


    /**
    * show division user manage with staff
    * @param int id : division's id
    * @return division's info with staff
    */ 
    public function show($id)
    {
    	$division = Division::find($id);
    	if($division && (Auth::user() == $division->manager || Auth::user()->isAdmin ) )
    	{
    		return view('division.show',['division'=>$division]);
    	}
    	else 
    		return redirect()->route('divisions.index');
    }


    /**
    * search user to insert to division
    * @param $request
    * @return list user has name like request
    */ 
    public function search(Request $request)
    {
    	$name = $request->name;
    	return User::where('name', 'LIKE', "%$name%")->get();
    }
}
