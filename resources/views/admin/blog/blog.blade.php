@extends('admin.layout.layouts')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create Blog
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Blog Management</li>
            </ol>
        </section>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Blog</h3>
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
                    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Blog Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                        required>
                                </div>
                            </div>

                            <!-- Slug -->
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control"
                                        required>
                                </div>
                            </div> --}}

                            <!-- Description -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Meta Title -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Meta Description -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>

                            <!-- Tag -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tags (comma separated)</label>
                                    <textarea name="tag" class="form-control">{{ old('tag') }}</textarea>
                                </div>
                            </div>

                            <!-- Cover Image -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control">
                                </div>
                            </div>

                            <!-- Banner Image -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control">
                                </div>
                            </div>

                            <!-- Author -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" name="author" value="{{ old('author') }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Related Blog</label>
                                    <select name="related_blog" class="form-control">
                                        @if ($blogs->count() > 0)
                                            <option value="">-- Select Related Blog --</option>
                                            @foreach ($blogs as $related)
                                                <option value="{{ $related->id }}"
                                                    {{ old('related_blog') == $related->id ? 'selected' : '' }}>
                                                    {{ $related->title }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">No related blogs available</option>
                                        @endif
                                    </select>
                                </div>
                            </div>



                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">-- Select Status --</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Available
                                        </option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Not Available
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Create Blog</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
