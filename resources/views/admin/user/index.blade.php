@extends('admin.index')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{trans('text.user')}}
                    <small>{{trans('text.list')}}</small>
                </h1>
                @if(session('flash'))
                    <div class="alert alert-success">{{session('flash')}}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" >
                <thead>
                    <tr align="center" >
                        <th class="center">{{trans('text.choose_to_reset_pass')}}</th>
                        <th class="center">{{trans('text.username')}}</th>
                        <th class="center">{{trans('text.email')}}</th>
                        <th class="center">{{trans('text.active')}}</th>
                        <th class="center">{{trans('text.division')}}</th>
                        <th class="center">{{trans('text.delete')}}</th>
                        <th class="center">{{trans('text.edit')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="odd gradeX" align="center" id = "user_{{$user->id}}">
                            <td><input type="checkbox" value="{{$user->id}}" class="choose-to-resetPassword"></td>
                            <td><a href="{{url('admin/users/'.$user->id)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->isActive)
                                    <i class="fa fa-check" aria-hidden="true"></i></td>
                                @endif
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
                            <td class="center"><i class="fa fa-trash-o fa-fw " ></i> <a href="#" class="delete-user-btn" data={{$user->id}}>{{trans('text.delete')}}</a></td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/users/'.$user->id.'/edit')}}">{{trans('text.edit')}}</a></td>  
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary click-to-reset">{{trans('text.reset_password')}}</button>
            <a href="{{route('exportExcel')}}" class="btn btn-primary">{{trans('text.export_to_excel')}}</a>
            <a href="{{url('admin/users/create')}}" class="btn btn-primary">{{trans('text.add_user')}}</a>
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
                var check = confirm("Want to delete?");
                if (check) {
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
                }
            });

            $('.click-to-reset').click(function(){
                var list_id = [];
                $('.choose-to-resetPassword:checked').each(function(i){
                    list_id[i] = $(this).val();
                });
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post("/admin/passwordReset",
                {
                  data: list_id,
                },
                function(respont){
                    alert('ok');
                    location.reload();
                });
            });
        });
    </script>
@endsection
