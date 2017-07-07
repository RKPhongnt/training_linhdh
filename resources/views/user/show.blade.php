@extends('layouts.index')
@section('content')
	<p>name: {{$user->name}}</p>
	<p>email: {{$user->email}}</p>
@endsection