@extends('admin.layout.layouts')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h1>
    </section>

    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

                <form action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Blog Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blog Category</label>
                                <select name="category_id" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $blog->category_id ?? '') == $cat->id ? 'selected' : '' }}>
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
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $blog->title ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ old('description', $blog->description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Meta Title -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"
                                    value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea name="meta_description" class="form-control">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tags (comma separated)</label>
                                <textarea name="tag" class="form-control">{{ old('tag', $blog->tag ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Cover Image -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cover Image</label>
                                <input type="file" name="cover_image" class="form-control">
                                @if (isset($blog) && $blog->cover_image)
                                    <img src="{{ asset('admin/uploads/blog/' . $blog->cover_image) }}" width="100" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <!-- Banner Image -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Banner Image</label>
                                <input type="file" name="banner_image" class="form-control">
                                @if (isset($blog) && $blog->banner_image)
                                    <img src="{{ asset('admin/uploads/blog/' . $blog->banner_image) }}" width="100" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <!-- Author -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" name="author" class="form-control"
                                    value="{{ old('author', $blog->author ?? '') }}">
                            </div>
                        </div>

                        <!-- Related Blog -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Related Blog</label>
                                <select name="related_blog" class="form-control">
                                    <option value="">-- Select Related Blog --</option>
                                    @foreach ($blogs as $related)
                                        <option value="{{ $related->id }}"
                                            {{ old('related_blog', $blog->related_blog ?? '') == $related->id ? 'selected' : '' }}>
                                            {{ $related->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="1" {{ old('status', $blog->status ?? '') == '1' ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('status', $blog->status ?? '') == '0' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">
                                {{ isset($blog) ? 'Update Blog' : 'Create Blog' }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
@endsection
