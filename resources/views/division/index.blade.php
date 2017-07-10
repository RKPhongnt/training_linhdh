@extends('layouts.index')
@section('content')
	<div class="container">
		<div class="row">
			@foreach($divisions as $div)
				<div class="col-md-4">
				    <div class="thumbnail">
				      	<div class="caption">
					        <h3>{{$div->name}}</h3>
					        @foreach($div->staffs as $staff)
					        	<p>{{$staff->name}}</p>
					        @endforeach
					        <p><a href="{{route('divisions.show',$div->id)}}" class="btn btn-primary" role="button">view</a> </p>
					    </div>
				    </div>
				</div>
			@endforeach
		</div>
	</div>
@endsection