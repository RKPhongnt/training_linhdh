@extends('layouts.index')
@section('content')
	<div class="container">
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
				@if($user->is_current_user($user))
					<li class="list-group-item"><a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">{{trans('text.edit')}}</a></li>
				@endif
			</ul>
			<div class="col-md-3">
                <div class="img-circle avatar">
                    <img class="img-circle avatar " 
	                    @if($user->avatar)
	                            src="{{Storage::url('avatars/'.$user->avatar)}}"
	                        @else
	                            src="https://thumbs.dreamstime.com/t/profile-icon-male-avatar-portrait-casual-person-silhouette-face-flat-design-vector-46846326.jpg"
	                        @endif
	                    />
                </div>  
            </div>
		</div>
	</div>
@endsection
