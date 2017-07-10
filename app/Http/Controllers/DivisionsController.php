<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Division;
use App\User;
class DivisionsController extends Controller
{
    //
    //public $current_user = Auth::user();
	
    public function index()
    {	
    	$divisions = Auth::user()->divisions ;
    	return view('division.index',['divisions'=>$divisions]);
    }

    public function show($id)
    {
    	$division = Division::find($id);
    	if($division)
    	{
    		return view('division.show',['division'=>$division]);
    	}
    }

    public function search(Request $request)
    {
    	$name = $request->name;
    	return User::where('name', 'LIKE', "%$name%")->get();
    }
}
