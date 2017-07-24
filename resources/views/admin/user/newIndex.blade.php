@extends('admin.index')
@section('admin')	
	<section class="page-wapper">
		<section class="choose-bar ">
			<div class="container">
				<div  class="row">
					<div>
						<div class="col-sm-4">
							<div class="select-bar ">
								<select class="select-division">
									<option selected disabled>select divisions</option>
									@foreach($divisions as $div)
										<option value="{{$div->id}}">{{$div->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="search-bar search-user">
								<input class="" placeholder="Enter user"/>
								<button>Search</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="content container">
			<section class="pull-left adventive">
				<img src="img/adv.png" class="img">
			</section>
			<section class="pull-left list-item">
				<div class="row">
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
				</div>
			</section>
		</section>
	</section>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.select-division').change(function(){
            	var id = $(this).val();
            	$.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.get("/admin/user-in-divisions/"+id,
                
	                function(respont){
	                    console.log(respont);
	                    $('.content').html("");
	                    $('.content').append(respont);
	                }
	            );
            });

            $('.search-user button').click(function(){
            	var name = $('.search-user input').val(); 
            	console.log(name);
            	$.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post("/admin/searchUser/",
                	{
                		data: name,
                	},
	                function(respont2){
	                    console.log(respont2);
	                    $('.content').html("");
	                    $('.content').append(respont2);
	                }
	            );
            })
        });
    </script>
@endsection
