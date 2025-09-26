@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <h1>
                Blog
                <small>Management</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Blog</a></li>
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
                            <h3 class="box-title">Blog Management</h3>

                            <div class="pull-right">
                                <a href="{{ url('admin/blogs') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Create Blog
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <table id="userManagementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Blog Category</th>
                                        <th>title</th>
                                        <th>cover image</th>
                                        <th>banner image</th>
                                        <th>author</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $index => $blog)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $blog->category->category ?? 'N/A' }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>
                                                @if ($blog->cover_image)
                                                    <img src="{{ asset('admin/uploads/blog/' . $blog->cover_image) }}"
                                                        width="60">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($blog->banner_image)
                                                    <img src="{{ asset('admin/uploads/blog/' . $blog->banner_image) }}"
                                                        width="60">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $blog->author ?? 'N/A' }}</td>
                                            <td>
                                                @if ($blog->status)
                                                    <span class="badge badge-success">Available</span>
                                                @else
                                                    <span class="badge badge-danger">Not Available</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Add edit/delete routes -->
                                                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Blog Category</th>
                                        <th>title</th>
                                        <th>cover image</th>
                                        <th>banner image</th>
                                        <th>author</th>
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
