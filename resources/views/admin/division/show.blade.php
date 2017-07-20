@extends('admin.index')
@section('admin')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header division-content" data-division={{$division->id}}>{{$division->name}}
                <small>{{trans('text.list_user')}}</small>
            </h1>
            @if(session('flash'))
                <div class="alert alert-success">{{session('flash')}}</div>
            @endif
        </div>
        <!-- /.col-lg-12 -->
        <table class="table table-striped table-bordered table-hover list-user-in-division" >
            <thead>
                <tr align="center">
                    <th class="center">{{trans('text.id')}}</th>
                    <th class="center">{{trans('text.username')}}</th>
                    <th class="center">{{trans('text.email')}}</th>
                    <th class="center">{{trans('text.delete')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($division->staffs as $user)
                    <tr class="odd gradeX" align="center" id = "user_{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td><a href="{{url('admin/users/'.$user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td class="center"><i class="fa fa-trash-o fa-fw " ></i> <a href="#" class="delete-user-btn" data={{$user->id}}>{{trans('text.delete')}}</a></td>                            
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-md-12">
            <a href="{{route('exportExcelUserInDivision',$division->id)}}" class="btn btn-primary">{{trans('text.export_to_excel')}}</a>
        </div>
       	<div class="form-group col-md-3">
            <label>{{trans('text.insert_new_user')}}</label>
            <input class="form-control" name="name"  id="insert-user" />
        </div>
        <div class="result col-md-3 list-group"></div>
        
    </div>
    <!-- /.row -->
    
@endsection
@section('script')
	<script type="text/javascript">
		function addUser(id) {
   		 	$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var division_id = $('.division-content').attr('data-division');
            $.post('/users/'+id+'/update',
		        {
		           division_id: division_id,
		        },
		        function(response){
		        	$('.list-user-in-division tbody').prepend(
		        		'<tr class="odd gradeX" align="center" id = "user_'+response.id+'">'+
                            '<td>'+response.id+'</td>'+
                            '<td>'+response.name+'</td>'+
                            '<td>'+response.email+'</td>'+
                            '<td class="center">'+
                            	'<i class="fa fa-trash-o fa-fw " ></i>'+
                            	'<a href="#" class="delete-user-btn" data='+response.id+'>Delete</a>'+
                            '</td>'+
                        '</tr>'		
		        	);
		        });
		}

		$(document).ready(function(){
            $('#insert-user').keyup(function(){
            	$('.result').html("");
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var data = $(this).val();
                $.post("/search",
		        {
		          name: data,
		        },
		        function(respont){
		        	for(var i=0; i<respont.length; i++)
		        	{
		        		$('.result').prepend('<a href="#" onclick="addUser(this.id)" id='+respont[i].id+' class="list-group-item">'+respont[i].name+'</a>');
		        	}
		            
		        });
            });
        });
	</script>
@endsection
