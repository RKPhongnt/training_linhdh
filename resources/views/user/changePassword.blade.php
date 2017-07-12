@extends('layouts.index')
@section('content')
	<div class="container">
		@if(session('flash'))
            <div class="alert alert-success">{{session('flash')}}</div>
        @endif
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3>Change password</h3>
			  	<form action="{{url('changePassword/'.$user->id)}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>New password</label>
                        <input class="form-control" type="password" name="password" required />
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
			</div>
		</div>
	</div>
@endsection
