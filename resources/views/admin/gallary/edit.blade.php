@extends('admin.layout.layouts')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Edit Gallery
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Gallery Management</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Gallery</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-remove"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('gallary.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                                        class="form-control" required>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Change Image (optional)</label>
                                    <input type="file" name="images" class="form-control">
                                </div>

                                 <div class="form-group">
                                    <label>Current Image</label><br>
                                    <img src="{{ asset('admin/gallery/' . $gallery->images) }}" width="80" alt="current image">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Gallery</button>
                        <a href="{{ url('admin/gallary-management') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
