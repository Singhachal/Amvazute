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
                            <a href="{{ route('create-blog-categories') }}" class=" btn btn-success mt-4">
                                Add Blog Categories
                            </a>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="userManagementTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogCategories as $blogCategory)
                                <tr>
                                    <td>{{ $blogCategory['id'] }}.</td>
                                    <td>{{ $blogCategory['category'] }}</td>
                                    <td class="text-center">
                                        <label class="switch availability-switch"
                                            onchange="checkStatus({{ $blogCategory->id }});">
                                            <input type="checkbox" {{ $blogCategory->status == 1 ? 'checked' : '' }}
                                                data-val="{{ $blogCategory->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{ route('edit-blog-categories', ['id' => $blogCategory->id]) }}"
                                                class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete-blog-categories', ['id' => $blogCategory->id]) }}"
                                                class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
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