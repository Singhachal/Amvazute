
@extends('admin.layout.layouts')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create Blog Category
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Blog Category Management</li>
        </ol>
    </section>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create Blog Category</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-remove"></i>
                    </button>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{ route('store-blog-categories') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blog Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Blog Category">
                            </div>

                        </div>
                        @error('category')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Submit Button Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('blog-categories-list') }}" class="btn btn-outline-dark mb-5">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection