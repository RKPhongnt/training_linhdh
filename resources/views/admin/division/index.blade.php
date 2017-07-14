@extends('admin.index')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{trans('text.division')}} 
                    <small>{{trans('text.list')}}</small>
                </h1>
                @if(session('flash'))
                    <div class="alert alert-success">{{session('flash')}}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <a href="{{route('divisions.create')}}" class="btn btn-primary">{{trans('text.add_division')}}</a>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>{{trans('text.id')}}</th>
                        <th>{{trans('text.name')}}</th>
                        <th>{{trans('text.manager')}}</th>
                        <th>{{trans('text.delete')}}</th>
                        <th>{{trans('text.edit')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($divisons as $division)
                        <tr class="odd gradeX" align="center" id = "user_{{$division->id}}">
                            <td>{{$division->id}}</td>
                            <td>
                                <a href="{{url('admin/divisions/'.$division->id)}}">{{$division->name}}</a>
                            </td>
                            <td>{{$division->manager->name}}</td>
                            <td class="center"><i class="fa fa-trash-o fa-fw " ></i> <a href="#" class="delete-user-btn" data={{$division->id}}>{{trans('text.delete')}}</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url('admin/divisions/'.$division->id.'/edit')}}">{{trans('text.edit')}}</a></td>  
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
                    url: '/admin/divisions/'+data,
                    type: 'DELETE',  // user.destroy
                    success: function(result) {  
                    }
                });
                $(this).closest('tr').hide();
            });
        });
    </script>
@endsection
