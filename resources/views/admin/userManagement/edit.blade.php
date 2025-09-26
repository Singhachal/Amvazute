@extends('admin.layout.layouts')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User Management Form
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">User Management</li>
            </ol>
        </section>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">User Management</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('admin.user.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password (leave blank to keep existing)</label>
                               <input type="password" name="password" class="form-control">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" name="number" value="{{ old('number', $admin->number) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" {{ $admin->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $admin->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $admin->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control">{{ old('bio', $admin->bio) }}</textarea>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Profile Picture</label><br>
                                @if($admin->profile_picture)
                                    <img src="{{ asset('admin/uploads/' . $admin->profile_picture) }}" width="80" class="mb-2 img-circle"><br>
                                @endif
                                <input type="file" name="profile_picture" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
