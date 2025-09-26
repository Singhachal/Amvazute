@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Gallary
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Gallary</a></li>
                <li class="active">Management</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Gallary Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/gallary-management/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Gallary
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>title</th>
                                        <th>Images</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galleries as $index => $gallery)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $gallery->title }}</td>
                                            <td>
                                                <img src="{{ asset('admin/gallery/' . $gallery->images) }}"
                                                    alt="gallery image" width="80">
                                            </td>
                                            <td>
                                                <a href="{{ route('gallary.status', $gallery->id) }}"
                                                class="btn btn-sm {{ $gallery->status === 'active' ? 'btn-success' : 'btn-warning' }}">
                                                    {{ ucfirst($gallery->status) }}
                                                </a>
                                            </td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('gallary.edit', $gallery->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                                <!-- Delete Button -->
                                                <a href="{{ route('gallary.delete', $gallery->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this gallery item?');"
                                                class="btn btn-danger btn-sm">
                                                    Delete
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>title</th>
                                        <th>Image</th>
                                        <th>Status</th>
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
