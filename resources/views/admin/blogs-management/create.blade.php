@extends('admin.layout.layouts')
@section('content')

<style>
#cke_notifications_area_description { display: none !important; }

.multiCategory .select2 .selection .select2-selection {
    display: block;
    width: 100%;
    padding: .1rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 2;
    color: #212529;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .375rem;
}

.multiCategory .select2-search__field {
    margin-top: 0 !important;
    height: 31px !important;
}

.tags-input {
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    width: 100%;
}
.tags-input ul { list-style: none; padding: 0; margin: 0; }
.tags-input li {
    display: inline-block;
    background: dodgerblue;
    color: #fff;
    border-radius: 20px;
    padding: 5px 10px;
    margin: 3px;
}
.tags-input input { border: none; outline: none; padding: 5px; font-size: 14px; }
.tags-input .delete-buttons { background: transparent; border: none; color: red; margin-left: 5px; cursor: pointer; }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Blog <small>Preview</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Blog Management</li>
        </ol>
    </section>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create Blog</h3>
            </div>

            <div class="box-body">
                <form id="blogForm" method="post" action="{{ route('store-blogs') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <!-- Blog Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blog Category</label>
                                <select class="form-control" id="blog_category_id" name="blog_category_id[]" multiple>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($allCategory as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ in_array($category->id, old('blog_category_id', [])) ? 'selected' : '' }}>
                                            {{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('blog_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Meta Title -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                                @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                                @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Related Blogs -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Related Blogs</label>
                                <select class="form-control" id="related_blogs" name="related_blogs[]" multiple>
                                    @foreach ($allBlogs as $b)
                                        <option value="{{ $b->id }}" {{ in_array($b->id, old('related_blogs', [])) ? 'selected' : '' }}>
                                            {{ $b->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('related_blogs') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tags</label>
                                <div class="tags-input">
                                    <ul id="tags"></ul>
                                    <input type="text" id="input-tag" placeholder="Enter tag name">
                                </div>
                            </div>
                        </div>

                        <!-- Cover Image -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cover Image</label>
                                <input type="file" class="form-control" name="cover_image">
                                @error('cover_image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Banner Image -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Banner Image</label>
                                <input type="file" class="form-control" name="banner_image">
                                @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Author -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Author</label>
                                <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}">
                                @error('author_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="blog_status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('blog_status') === '1' ? 'selected' : '' }}>ON</option>
                                    <option value="0" {{ old('blog_status') === '0' ? 'selected' : '' }}>OFF</option>
                                </select>
                                @error('blog_status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Create Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
CKEDITOR.replace('description', { height: 300 });

const tags = document.getElementById('tags');
const input = document.getElementById('input-tag');
const addedTags = new Set();

input.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const tagContent = input.value.trim();
        if (tagContent && !addedTags.has(tagContent)) {
            addedTags.add(tagContent);
            const tag = document.createElement('li');
            tag.innerHTML = `${tagContent} <button type="button" class="delete-buttons"><i class="fa fa-times"></i></button>`;
            tags.appendChild(tag);
            input.value = '';
            tag.querySelector('.delete-buttons').addEventListener('click', function() {
                addedTags.delete(tagContent);
                tags.removeChild(tag);
            });
        }
    }
});

document.getElementById('blogForm').onsubmit = function() {
    addedTags.forEach(tag => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'tags[]';
        hiddenInput.value = tag;
        this.appendChild(hiddenInput);
    });
};

$(function(){
    $('#blog_category_id, #related_blogs').select2({
        placeholder: "Select option",
        tags: true,
        closeOnSelect: false
    });
});
</script>
@endpush
@endsection
