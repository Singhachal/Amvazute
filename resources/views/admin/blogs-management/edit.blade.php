@extends('admin.layout.layouts')
@section('title', 'Edit Blogs')
@section('meta_description', 'Kanha Edit Blogs')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-4 bg-white">
        <style>
            #cke_notifications_area_description{
                display: none !important;
            }
            .multiCategory .select2 .selection .select2-selection {
                /* height: 2.35rem; */
                display: block;
                width: 100%;
                padding: .1rem 0.75rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 2;
                color: #212529;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border-radius: .375rem;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }

            .multiCategory .select2 .selection .select2-selection .select2-search .select2-search__field {
                margin-top: 0px;
                height: 31px !important;
            }

            #input-tag {
                width: 100% !important;
            }

            .tags-input {
                display: inline-block;
                position: relative;
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 5px;
                box-shadow: 2px 2px 5px #00000033;
                width: 100%;
            }

            .tags-input ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .tags-input li {
                display: inline-block;
                background-color: dodgerblue;
                color: white;
                border-radius: 20px;
                padding: 5px 10px;
                margin-right: 5px;
                margin-bottom: 5px;
            }

            .tags-input input[type="text"] {
                border: none;
                outline: none;
                padding: 5px;
                font-size: 14px;
            }

            .tags-input input[type="text"]:focus {
                outline: none;
            }

            .tags-input .delete-buttons {
                background-color: transparent;
                border: none;
                color: red;
                cursor: pointer;
                margin-left: 5px;
            }

            .tags-input li:hover {
                background-color: #e0e0e0;
                /* Hover effect for tags */
            }

            .tags-input .delete-buttons:hover {
                color: #ff4d4d;
                /* Change color on hover for delete button */
            }
        </style>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Blogs</h1>
        </div>

        <form id="blogForm" method="post" action="{{ route('update-blogs', ['id' => $blog['id']]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6 multiCategory">
                    <label for="blog_category_id" class="form-label">Blog Category</label>
                    <select class="form-select" id="blog_category_id" name="blog_category_id[]" multiple>
                        @foreach ($allCategories as $category)
                            <option value="{{ $category->id }}" @if ($blog->blogCategories->contains($category->id)) selected @endif>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                    @error('blog_category_id')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                        value="{{ old('title', $blog->title) }}">
                    @error('title')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-12 my-2 multiCategory">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title"
                        value="{{ old('meta_title', $blog->meta_title) }}">
                    @error('meta_title')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        @error('meta_description')
                            <span class="alert alert-danger my-3">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-12 my-2 multiCategory">
                    <label for="related_blogs" class="form-label">Related Blogs</label>
                    <select class="form-select" id="related_blogs" name="related_blogs[]" multiple>
                        @foreach ($allBlogs as $blogs)
                            <option value="{{ $blogs->id }}" @if (!is_null(json_decode($blog->related_blogs)) && in_array($blogs->id, json_decode($blog->related_blogs))) selected @endif>
                                {{ $blogs->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('related_blogs')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-sm-12">
                    <label for="tags" class="form-label">Tags</label>
                    <br>
                    <div class="tags-input">
                        <ul id="tags">
                            @foreach (json_decode($blog->tags, true) ?? [] as $tag)
                                <li>
                                    {{ $tag }}
                                    <button type="button" class="delete-buttons">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        <input type="text" id="input-tag" name="tags[]" placeholder="Enter tag name" />
                    </div>
                    @error('tags.*')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6 mt-3">
                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image"
                            placeholder="Cover Image">
                        @if ($blog->cover_image)
                            <img src="{{ asset('admin/uploads/blogs/' . $blog->cover_image) }}" alt="Current Cover Image"
                                style="max-width: 150px; margin-top: 10px;">
                        @endif
                    </div>
                    @error('cover_image')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6 mt-3">
                    <div class="mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image"
                            placeholder="Banner Image">
                        @if ($blog->banner_image)
                            <img src="{{ asset('admin/uploads/blogs/' . $blog->banner_image) }}" alt="Current Banner Image"
                                style="max-width: 150px; margin-top: 10px;">
                        @endif
                    </div>
                    @error('banner_image')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="author_name" class="form-label">Author Name</label>
                        <input type="text" class="form-control" id="author_name" name="author_name"
                            placeholder="Author Name" value="{{ old('author_name', $blog->author_name) }}">
                    </div>
                    @error('author_name')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="blog_status" class="form-label">Status</label>
                        <select class="form-select" id="blog_status" name="blog_status">
                            <option value="">Select Status</option>
                            <option value="1" {{ $blog->blog_status === 1 ? 'selected' : '' }}>ON</option>
                            <option value="0" {{ $blog->blog_status === 0 ? 'selected' : '' }}>OFF</option>
                        </select>
                    </div>
                    @error('blog_status')
                        <span class="alert alert-danger my-3">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $blog->description) }}</textarea>
                        @error('description')
                            <span class="alert alert-danger my-3">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('blogs-list') }}" class="btn btn-outline-dark mb-5">Back</a>
                </div>
            </div>
        </form>
    </main>
    @push('scripts')
        <script>
            CKEDITOR.replace('description', {
                height: 300,
                toolbar: [{
                        name: 'clipboard',
                        items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo']
                    },
                    {
                        name: 'styles',
                        items: ['Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', 'Blockquote']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule', 'Link']
                    }
                ]
            });

            const tags = document.getElementById('tags');
            const input = document.getElementById('input-tag');

            // Store added tags to prevent duplicates
            const addedTags = new Set();

            // Function to handle tag removal
            function removeTag(tagContent) {
                addedTags.delete(tagContent);
                const tagItems = tags.getElementsByTagName('li');
                for (let tagItem of tagItems) {
                    if (tagItem.innerText.includes(tagContent)) {
                        tags.removeChild(tagItem);
                        break;
                    }
                }
            }

            // Add an event listener for keydown on the input element
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission on Enter
                    const tagContent = input.value.trim();

                    // Check for valid input before adding
                    if (tagContent && !addedTags.has(tagContent)) {
                        addedTags.add(tagContent);
                        const tag = document.createElement('li');
                        tag.innerText = tagContent;
                        tag.innerHTML += '<button type="button" class="delete-buttons">X</button>';
                        tags.appendChild(tag);
                        input.value = ''; // Clear input after adding

                        // Handle tag removal
                        tag.querySelector('.delete-buttons').addEventListener('click', function() {
                            addedTags.delete(tagContent); // Remove from Set
                            tags.removeChild(tag); // Remove from DOM
                        });
                    } else if (!tagContent) {
                        alert('Please enter a valid tag!');
                    } else {
                        alert('Tag already exists!');
                    }
                }
            });


            // Add event listener to existing tags for deletion
            document.querySelectorAll('#tags li').forEach(tag => {
                const tagContent = tag.innerText.replace('X', '').trim(); // Extract tag content
                tag.querySelector('.delete-buttons').addEventListener('click', function() {
                    removeTag(tagContent);
                    tags.removeChild(tag);
                });
            });

            document.getElementById('blogForm').onsubmit = function() {
                // Clear any existing hidden inputs (to avoid duplicates)
                const existingHiddenInputs = document.querySelectorAll('input[name="tags[]"]');
                existingHiddenInputs.forEach(input => input.remove());

                // Combine existing tags with new added tags
                const allTags = new Set(addedTags); // Start with new added tags

                // Add existing tags to the set (ensure no duplicates)
                document.querySelectorAll('#tags li').forEach(tag => {
                    const tagContent = tag.innerText.replace('X', '').trim(); // Extract tag content
                    allTags.add(tagContent);
                });

                // Create a hidden input for each tag (new + existing)
                allTags.forEach(tag => {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'tags[]';
                    hiddenInput.value = tag;
                    document.getElementById('blogForm').appendChild(hiddenInput);
                });
            };


            $(document).ready(function() {
                // Initialize Select2
                $('#blog_category_id, #related_blogs').select2({
                    allowClear: true,
                    placeholder: "Select option",
                    tags: true,
                    closeOnSelect: false
                });
            });
        </script>
    @endpush
@endsection
