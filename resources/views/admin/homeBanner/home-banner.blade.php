@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Home Banner
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Home Banner</a></li>
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
                            <h3 class="box-title">Home Banner Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/home-banner/create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Home Banner
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($banners as $index => $banner)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $banner->title }}</td>
                                            <td>{{ $banner->subtitle }}</td>
                                            <td>
                                                @if ($banner->image)
                                                    <img src="{{ asset($banner->image) }}" alt="Banner Image"
                                                        width="100">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                @if ($banner->status)
                                                    <a href="{{ route('admin.home-banner.toggleStatus', $banner->id) }}"
                                                        class="badge badge-success"
                                                        onclick="return confirm('Change status to inactive?')">Active</a>
                                                @else
                                                    <a href="{{ route('admin.home-banner.toggleStatus', $banner->id) }}"
                                                        class="badge badge-danger"
                                                        onclick="return confirm('Change status to active?')">Inactive</a>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.home-banner.edit', $banner->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('admin.home-banner.delete', $banner->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this banner?')">Delete</a>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No banners found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Title</th>
                                        <th>Sub Title</th>
                                        <th>Image</th>
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
