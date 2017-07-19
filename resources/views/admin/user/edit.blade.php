@extends('admin.index')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{trans('text.user')}}
                    <small>{{trans('text.list')}}</small>
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
                <form action="{{url('admin/users/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label>{{trans('text.username')}}</label>
                        <input class="form-control" name="name" placeholder="Please Enter Username" required value="{{$user->name}}" />
                    </div>
                    <div class="form-group">
                        <label>{{trans('text.division')}}</label>
                        <select name='division_id' class="form-control">
                            @foreach($divisions as $div)
                                <option value="{{$div->id}}"
                                    @if($div->id == $user->devision_id)
                                        selected 
                                    @endif
                                >{{$div->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{trans('text.password')}}</label>
                        <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
                    </div>
                    <div class="form-group">
                        <label>{{trans('text.avatar')}}</label>
                        <input type="file" class="form-control upload-avatar" name="avatar" />
                    </div>
                    <div class="form-group">
                        <label>{{trans('text.user_level')}}</label>
                        <label class="radio-inline">
                            <input name="isAdmin" value="1" type="radio">{{trans('text.admin')}}
                        </label>
                        <label class="radio-inline">
                            <input name="isAdmin" value="0" type="radio" checked="">{{trans('text.member')}}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">{{trans('text.save')}}</button>
                    <button type="reset" class="btn btn-default">{{trans('text.reset')}}</button>
                <form>
            </div>
            <div class="col-lg-3 ">
                <div class="img-circle avatar">
                    <img class="img-circle " 
                        @if($user->avatar)
                                src="{{Storage::url('avatars/'.$user->avatar)}}"
                            @else
                                src="https://thumbs.dreamstime.com/t/profile-icon-male-avatar-portrait-casual-person-silhouette-face-flat-design-vector-46846326.jpg"
                            @endif
                        />
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
