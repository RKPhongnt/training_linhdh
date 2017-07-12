@extends('admin.index')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>List</small>
                </h1>
                @if(session('flash'))
                    <div class="alert alert-success">{{session('flash')}}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
             <a href="{{url('admin/users/create')}}" class="btn btn-primary">Add User</a>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>division</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center" id = "user_{{$user->id}}">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->belongDivision)
                                    {{$user->belongDivision->name}}
                                @endif
                            </td>
                            
                                {{-- <i class="fa fa-trash-o  fa-fw"></i>
                                <button type="submit" form="form-delete-{{ $user->id }}"> Delete</button>

                                <form action="{{route('users.destroy',$user->id)}}" id="form-delete-{{ $user->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form> --}}
                            <td class="center"><i class="fa fa-trash-o fa-fw " ></i> <a href="#" class="delete-user-btn" data={{$user->id}}>Delete</a></td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/users/'.$user->id.'/edit')}}">Edit</a></td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

{{-- delete a row --}}
@section('script')
    <script>
        $(document).ready(function(){
            $('.delete-user-btn').click(function(){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var data = $(this).attr('data');
                $.ajax({
                    url: '/admin/users/'+data,
                    type: 'DELETE',  // user.destroy
                    success: function(result) {  
                    }
                });
                $(this).closest('tr').hide();
            });
        });
    </script>
@endsection
