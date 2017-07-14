<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Arr;


use App\User;
class ResetPasswordController extends AdminController
{
    //
    use SendsPasswordResetEmails;

    public function resetPassword(Request $rq)
    {
    	foreach ($rq->data as $id) {
    		$user = User::find($id);
    		$mail = $user->email;
    		$this->broker()->sendResetLink(['email'=>$mail]);
    	}
    }
}
