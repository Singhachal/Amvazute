@extends('admin.layout.layouts')
@section('title', 'Blogs')
@section('meta_description', 'Kanha Blogs')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-white">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Blog Reviews- <span class="text-danger">({{ $blogTitle }})</span></h1>
            {{-- <div class="row" style="float: right;">
                <div class="col-sm-12">
                    <a href="{{ route('create-blogs') }}" class=" btn btn-success mt-4">
                        Add Blogs
                    </a>
                </div>
            </div> --}}
        </div>

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
        <div class="top_fields">
            <div class="tabsection jungle ">
                <div class="table-responsive">
                    <table class="table tablesection border-light table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Email</th>
                                <th scope="col">Review</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogReviews as $blogReview)
                                <tr>
                                    <td>{{ $blogReview['id'] }}.</td>
                                    <td>{{ $blogReview['name'] }}</td>
                                    <td>{{ $blogReview['city'] }}</td>
                                    <td>{{ $blogReview['email'] }}</td>
                                    <td>{{ $blogReview['review'] }}</td>
                                    <td>{{ $blogReview['rating'] }}</td>
                                    <td class="text-center">
                                        <label class="switch availability-switch"
                                            onchange="checkStatus({{ $blogReview->id }});">
                                            <input type="checkbox" {{ $blogReview->blog_review_status == 1 ? 'checked' : '' }}
                                                data-val="{{ $blogReview->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{ route('delete-blogs-reviews', ['id' => $blogReview->id]) }}"
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
                <div class="pagination-container">
                    <p>
                        <b>
                            Total records: {{ $blogReviews->total() }},
                            Displaying records {{ $blogReviews->firstItem() }}
                            to {{ $blogReviews->lastItem() }}
                            of {{ $blogReviews->total() }}
                        </b>
                    </p>
                    {{ $blogReviews->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <footer class="d-flex p-2 justify-content-between">
                <div>
                    <h6>Copyright © 2024 Kanha National Park</h6>
                </div>
                <div>
                    <h6> © Daily tour & travel. All Rights Reserved</h6>
                </div>
            </footer>
        </div>
    </main>
    @push('scripts')
        <script>
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
                    url: '{{ route('update-blogs-reviews-status') }}',
                    data: JSON.stringify({
                        'id': id,
                        'blog_review_status': status
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
    @endpush
@endsection
