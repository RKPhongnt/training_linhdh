<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use App\User;
class ResetPasswordController extends AdminController
{
    //
    public function resetPassword(Request $rq)
    {
    	foreach ($rq->data as $id) {
    		$user = User::find($id);
    		$user->sendPasswordResetNotification($user->email);
    	}
    }
}
