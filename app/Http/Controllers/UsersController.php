<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use Auth;
class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user)
        {
            return view('user.show',['user'=>$user]);
        }
        else 
            return redirect('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user && $user == Auth::user())
        {
            return view('user.edit',['user'=>$user]);
        }
        else 
            return redirect('home');
    }

    /**
     * Update the specified use to division in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
        if ($user && $user == Auth::user()) {
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('users.show',$user->id)->with('flash','Update user success');
        } else {
            return redirect('users')->with('flash','No have user');
        }
    }

    /**
     * Update the specified use to division in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDivision(Request $request, $id)
    {
        //
        $user = User::find($id);
        $division = Division::find($request->division_id);

        if($user && (Auth::user() == $division->manager || Auth::user()->isAdmin ) )
        {
            $user->devision_id = $request->division_id;
            $user->save();
            return $user;
        }
        else 
            return false;
    }

    public function getChangePassword($id)
    {   
        $user = User::find($id);
        if($user && $user == Auth::user())
            return view('user.changePassword',['user'=>$user]);
        else 
            return redirect('home');
    }

    public function updatePassword(Request $rq, $id)
    {
        $user = User::find($id);
        if($user && $user == Auth::user())
        {
            $user->password = bcrypt($rq->password);
            $user->isActive = 1;
            $user->save();
            return redirect()->route('users.show',$user);
        }
        else 
            return redirect('home');
    }
}
