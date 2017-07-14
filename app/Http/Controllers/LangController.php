<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class LangController extends Controller
{
    /*
    *change languge
    */
    public function changeLang(Request $rq)
    {
    	Session::put('locale', $rq->locale);
    	return redirect()->back();
    }

}
