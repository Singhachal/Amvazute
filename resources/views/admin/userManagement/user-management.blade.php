@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                User
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">User</a></li>
                <li class="active">Management</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">User Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/user-management/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create User
                                </a>
                            </div>

                            <div class="pull-left">
                                <form method="GET" action="{{ url('admin/user-management') }}" class="form-inline">
                                    <div class="form-group">
                                        <select name="role" class="form-control" onchange="this.form.submit()">
                                            <option value="">-- Filter By Role --</option>
                                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="number" class="form-control" placeholder="Number" value="{{ request('number') }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                    <a href="{{ url('admin/user-management') }}" class="btn btn-default btn-sm">Reset</a>
                                </form>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($data->profile_picture)
                                                    <img src="{{ asset('admin/uploads/' . $data->profile_picture) }}"
                                                        alt="Profile" width="50" height="50" class="img-circle">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->number }}</td>
                                            <td>
                                                <form action="{{ route('admin.user-management.toggleStatus', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $data->status == 'active' ? 'btn-success' : 'btn-danger' }}">
                                                        {{ ucfirst($data->status) }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ ucfirst($data->role) }}</td>
                                            <td>
                                                <a href="{{ url('admin/user-management/edit/' . $data->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ url('admin/user-management/delete/' . $data->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this user?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
