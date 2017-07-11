@extends('layouts.index')
@section('content')
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif
                <form action="{{route('users.update', $user->id)}}" method="POST">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="name" placeholder="Please Enter Username" required value="{{$user->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Please Enter Password" required/>
                    </div>
                    <button type="submit" class="btn btn-default">User Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
