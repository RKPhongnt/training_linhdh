@extends('admin.index')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{trans('text.division')}}
                    <small>{{trans('text.edit')}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif
                <form action="{{route('divisions.update', $division->id)}}" method="POST">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>name</label>
                        <input class="form-control" name="name" placeholder="Please Enter Username" required value="{{$division->name}}" />
                    </div>
                    <div class="form-group">
                        <label>{{trans('text.manager')}}</label>
                        <select name="manager_id" required class="form-control">
                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                @if($division->manager->id == $user->id)
                                    selected 
                                @endif
                                >{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">{{trans('text.save')}}</button>
                    <button type="reset" class="btn btn-default">{{trans('text.reset')}}</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
