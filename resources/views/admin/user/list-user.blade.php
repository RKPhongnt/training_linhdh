@if($users)
	@foreach($users as $user)
		<div class="col-sm-3 item">
			<div class="border ">
				<div class="text-center border">
					<img class="img" style="width: 50px;height: 50px" 
	                    @if($user->avatar)
	                        src="{{Storage::url('avatars/'.$user->avatar)}}"
	                    @else
	                        src="https://thumbs.dreamstime.com/t/profile-icon-male-avatar-portrait-casual-person-silhouette-face-flat-design-vector-46846326.jpg"
	                    @endif
	                />
				</div>
				<p class="name-product">{{$user->name}}</p>
				<p class="clearfix">
					<span class="pull-left cost">
						@if($user->belongDivision)
	                        {{$user->belongDivision->name}}
	                    @else
	                    	Chưa có phòng ban
	                    @endif</span>
				</p>
			</div>
		</div>
	@endforeach

@endif
