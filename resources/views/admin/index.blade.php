@extends('layouts.index')
@section('content')
    <div id="wrapper">

        <!-- Navigation -->
        @include('admin.menu')
	
        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('admin')
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
@endsection