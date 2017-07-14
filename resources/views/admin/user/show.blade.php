@extends('admin.index')
@section('admin')
	<div class="">
		@if(session('flash'))
            <div class="alert alert-success">{{session('flash')}}</div>
        @endif
		<div class="row">
			<ul class="list-group col-md-6">
			  	<li class="list-group-item">{{trans('text.username')}}:       {{$user->name}}</li>
			  	<li class="list-group-item">{{trans('text.email')}}:          {{$user->email}}</li>
			  	<li class="list-group-item">{{trans('text.division')}}:       
					@if($user->belongDivision)
						{{$user->belongDivision->name}}</li>
					@else
						null
					@endif
			  	<li class="list-group-item"><a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-primary">{{trans('text.edit')}}</a></li>
			</ul>
		</div>
	</div>
@endsection
