<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use App\User;
class UsersController extends AdminController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
        	'name'=>'required|min:3',
        	'email'=>'required|email|unique:users,email',
        	'password'=>'required|min:6'
        ],
        [
        	'name.required' => 'name must requied',
			'name.min' => 'length name than 3 character',
			'email.required' => 'email must required',
			'email.email' => 'email not correct',
			'email.unique' => 'email existed',
			'password.required' => 'pass must required',
			'password.min' => 'pass too short'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->isAdmin = $request->isAdmin;
        $user->save();
        return redirect('admin/users')->with('flash','Create user success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        if($user)
        	return view('user.show',['user'=>$user]);
        else
        	return redirect('admin/users')->with('flash','No have user');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        if($user)
        	return view('user.edit',['user'=>$user]);
        else
        	return redirect('admin/users')->with('flash','No have user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       
         $this->validate($request,[
        	'name'=>'required|min:3',
        	'password'=>'required|min:6'
        ],
        [
        	'name.required' => 'name must requied',
			'name.min' => 'length name than 3 character',
			'password.required' => 'pass must required',
			'password.min' => 'pass too short'
        ]);
        $user = User::find($id);
        if ($user) {
        	$user->name = $request->name;
	        $user->password = bcrypt($request->password);
	        $user->isAdmin = $request->isAdmin;
	        $user->save();
        	return redirect('admin/users')->with('flash','Update user success');
        } else {
        	return redirect('admin/users')->with('flash','No have user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        if($user)
        {
        	$user->delete();
        	return true;
        }
        else
        	return false;
    }
}
