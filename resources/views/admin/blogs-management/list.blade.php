
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
                                <a href="{{ route('create-blogs') }}" class=" btn btn-success mt-4">
                                    Add Blogs
                                </a>
                            </div>
                        </div>

                        <div class="box-body">
                            <!-- <table id="userManagementTable" class="table table-bordered table-striped">
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
                            </table> -->

                            <table id="userManagementTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Cover Image</th>
                                <th scope="col">Banner Image</th>
                                <th scope="col">Blog Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog['id'] }}.</td>
                                    <td>{{ $blog['title'] }}</td>
                                    <td>
                                        <i class="fa fa-eye fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-blog-description="{{ $blog['description'] }}"></i>

                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Blog
                                                            Descriptions</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="modal-description"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach (json_decode($blog['tags']) ?? [] as $tags)
                                            <span class="badge text-bg-primary">
                                                {{ $tags }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <img height="75px" width="100px" src="{{ asset($blog['cover_image_url']) }}"
                                            alt="{{ $blog['cover_image'] }}">
                                    </td>
                                    <td>
                                        <img height="75px" width="100px" src="{{ asset($blog['banner_image_url']) }}"
                                            alt="{{ $blog['banner_image'] }}">
                                    </td>
                                    <td class="text-center">
                                        <label class="switch availability-switch"
                                            onchange="checkStatus({{ $blog->id }});">
                                            <input type="checkbox" {{ $blog->blog_status == 1 ? 'checked' : '' }}
                                                data-val="{{ $blog->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{ route('edit-blogs', ['id' => $blog->id]) }}"
                                                class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('blog-comments', ['id' => $blog->id]) }}"
                                                class="btn btn-success">
                                                <i class="fa-regular fa-comments"></i>
                                            </a>
                                            <a href="{{ route('delete-blogs', ['id' => $blog->id]) }}"
                                                class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var exampleModal = document.getElementById('exampleModal');
                exampleModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var blogDescription = button.getAttribute('data-blog-description');

                    var modalBody = exampleModal.querySelector('.modal-body');
                    modalBody.innerHTML = blogDescription;
                });
            });


            function checkStatus(id) {
                var checkbox = $('input[data-val="' + id + '"]');
                var status = checkbox.prop('checked') ? 1 : 0;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-blogs-status') }}',
                    data: JSON.stringify({
                        'id': id,
                        'status': status
                    }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function(response) {
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.msg,
                            });
                            location.reload();
                        }, 1);
                    },
                    error: function(error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to update availability. Please try again later.',
                        });
                    }
                });
            }
        </script>
@endsection

