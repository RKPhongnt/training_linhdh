<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use App\Division;
use App\User;
class DivisionsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $divisons = Division::all();
        return view('admin.division.index',['divisons'=>$divisons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view('admin.division.create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,
        [
            'name'=>'required',
            'manager_id'=>'required'
        ],
        [
            'name.required'=>'name is empty',
            'manager_id.required'=>'manager is empty'
        ]);
        $division = new Division;
        $division->name = $request->name;
        $division->manager_id = $request->manager_id;
        if($division->save())
            return redirect('admin/divisions')->with('flash','add division success');
        else
            return redirect('admin/divisions/create')->with('flash','add division false');
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
        $division = Division::find($id);
        return view('admin.division.show',['division'=>$division]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $division = Division::find($id);
        $users = User::all();
        return view('admin.division.edit',['division'=>$division, 'users'=>$users]);
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
        $this->validate($request,
        [
            'name'=>'required',
            'manager_id'=>'required'
        ],
        [
            'name.required'=>'name is empty',
            'manager_id.required'=>'manager is empty'
        ]);
        $division = Division::find($id);
        $division->name = $request->name;
        $division->manager_id = $request->manager_id;
        if($division->save())
            return redirect('admin/divisions')->with('flash','edit division success');
        else
            return redirect('admin/divisions/edit')->with('edit','add division false');
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
        $division = Division::find($id);
        if($division)
        {
            $division->delete();
            return true;
        }
        else
            return false;
    }
}
