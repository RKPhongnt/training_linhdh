@extends('admin.index')
@section('admin')
	<p>name: {{$user->name}}</p>
	<p>email: {{$user->email}}</p>
@endsection