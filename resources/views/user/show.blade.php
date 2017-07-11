@extends('layouts.index')
@section('content')
	<div class="container">
		@if(session('flash'))
            <div class="alert alert-success">{{session('flash')}}</div>
        @endif
		<div class="row">
			<ul class="list-group col-md-6">
			  	<li class="list-group-item">Username:       {{$user->name}}</li>
			  	<li class="list-group-item">Email:          {{$user->email}}</li>
			  	<li class="list-group-item">Division:       {{$user->belongDivision->name}}</li>
			  	<li class="list-group-item"><a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a></li>
			</ul>
		</div>
	</div>
@endsection
