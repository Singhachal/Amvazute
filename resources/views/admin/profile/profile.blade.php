@extends('admin.layout.layouts')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">User profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                            src="{{ $admin->profile_picture ? asset('admin/uploads/' . $admin->profile_picture) : asset('admin/assets/img/user4-128x128.jpg') }}"
                            alt="User profile picture">


                            <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>
                            <h4 class="profile-username text-center">{{ $admin->number }}</h4>
                            <h4 class="profile-username text-center">{{ $admin->email }}</h4>
                            <p class="text-muted text-center">{{ $admin->bio }}</p>

                            {{-- <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="pull-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="pull-right">13,287</a>
                                </li>
                            </ul> --}}

                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <div class="col-md-9">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">Change Password</h3>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="margin: 0;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('admin.change.password') }}">
                            @csrf

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="current_password" class="col-sm-3 control-label">Current Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new_password" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="new_password_confirmation" class="col-sm-3 control-label">Confirm New
                                        Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="new_password_confirmation"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger pull-right">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
