<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use App\User;
use App\Division;
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
        return view('admin.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $divisions = Division::all();
        return view('admin.user.create',['divisions'=>$divisions]);
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
        $user->devision_id = $request->division_id;
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
        	return view('admin.user.show',['user'=>$user]);
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
        $divisions = Division::all();
        if($user)
        	return view('admin.user.edit',['user'=>$user, 'divisions'=>$divisions]);
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
        ],
        [
        	'name.required' => 'name must requied',
			'name.min' => 'length name than 3 character',
        ]);
        $user = User::find($id);
        if ($user){
        	$user->name = $request->name;
	        $user->isAdmin = $request->isAdmin;
            $user->devision_id = $request->division_id;
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
        if($user){
        	$user->delete();
        	return true;
        } else
        	return false;
    }
}
