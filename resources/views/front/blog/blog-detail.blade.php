@extends('front.layouts.main')
@php
$queryString = request()->getQueryString();
$queryString = $queryString ?? '';
@endphp
@section('meta_title', $currentBlog->meta_title . '' . $queryString)
@section('meta_description', $currentBlog->meta_description . '' . $queryString)
@section('links', 'https://kanhanationalpark.in' . $_SERVER['REQUEST_URI'])
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
    rel="stylesheet">

<style>
.searchinfo {
    list-style-type: none;
    padding: 0;
    margin-top: -6px;
    display: none;
    border: 1px solid #ccc;
    position: absolute;
    background-color: white;
    max-height: 200px;
    width: 260px;
    overflow-y: auto;
    border-radius: 5px;
}

.searchinfo li {
    line-height: 25px !important;
}

.starpkg {
    margin-right: 2px;
    font-size: 23px;
    width: 28px;
    height: 28px;
    transition: .6s all;
}

.star-icon {
    color: gray;
    font-size: 24px;
    cursor: pointer;
}
</style>
<main class="contact">
    <section class="mt-5 pt-4 breadcrumbs">
        <div class="container">
            <div class="row mt-5 margin-on-mobile">
                <h1 class="col text-light fw-semibold fs-1 text-on-mobile">Blog Details</h1>
                <h2 class="text-light fs-5 text-on-mobile-h5">
                    <a href="/">Home</a>&emsp;<span>/&emsp;Blog Details</span>
                </h2>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row gx-3 gy-2">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="card" style="border: 1px solid rgb(168, 165, 165);">
                                <a href="#">
                                    <img src="{{ asset($currentBlog->banner_image_url) }}" height="182"
                                        alt="{{ $currentBlog->title }}" class="card-img-top img-detailss">
                                </a>
                                <div class="card-body card-body-padding">
                                    <div class="row d-flex justify-content-center m-0 p-0">
                                        <div class="col m-0 pb-1 px-0"><i
                                                class="fa-solid fa-circle-user small-cnt-color"></i>&nbsp;{{ $currentBlog->author_name }}
                                        </div>
                                        <div class="col m-0 pb-1 px-0"><i
                                                class="fa-regular fa-calendar-days small-cnt-color"></i>&nbsp;{{ $currentBlog->created_at->format('F d, Y') }}
                                        </div>
                                    </div>
                                    <div class="py-2">
                                        <p class="class-imgss px-2 mb-0 pb-0"><b>Tag:</b>
                                            @if (!empty($currentBlog->tags))
                                            @php
                                            $tags = json_decode($currentBlog->tags);
                                            @endphp

                                            @if (count($tags) == 1)
                                            <span>{{ $tags[0] }}</span>
                                            @else
                                            @foreach ($tags as $index => $tag)
                                            <span>&nbsp;
                                                {{ $tag }}{{ $index != count($tags) - 1 ? ',' : '' }}</span>
                                            @endforeach
                                            @endif
                                            @endif
                                        </p>
                                    </div>
                                    <h3 class="card-title mt-1 "><a class="small-cnt-color fw-semibold"
                                            href="#">{{ $currentBlog->title }}</a>
                                    </h3>

                                    {{-- <h5 class="fw-semibold small-cnt-color">1. Bengal Tiger (Panthera Tigris Tigris)
                                        </h5> --}}

                                    <p class="card-text">{!! $currentBlog->description !!}</p>
                                </div>

                            </div>
                            <div class="col-lg-12">

                                <div class="row">
                                    <h2 class="fw-semibold mid-text pt-3">Related Post
                                    </h2>
                                    @if ($relatedBlogs->isNotEmpty())
                                    @foreach ($relatedBlogs as $blog)
                                    <div class="col-md-4 col-sm-12 mb-2">
                                        <div class="card" style="border: 1px solid rgb(168, 165, 165);">
                                            <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                                                <img src="{{ asset($blog->cover_image_url) }}" height="182"
                                                    alt="{{ $blog->title }}" class="card-img-top">
                                            </a>
                                            <div class="card-body card-body-padding">

                                                <h5 class="card-title mt-1 pb-2 "><a class="small-cnt-color fw-semibold"
                                                        href="{{ route('blog-details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                                </h5>

                                                <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}"
                                                    class="btn-blogs btn--with-icon"><i
                                                        class="btn-icon fa fa-long-arrow-right"></i>READ
                                                    MORE</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p>No related blogs available at the moment.</p>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="sidebar">
                        <aside id="block-3" class="widget mb-5 p-3 widget_block">
                            <div class="enquiry-form" id="enquiryForm">
                                <h4 class="text-center wp-block-search__label  fw-semibold  fs-4 small-cnt-color mb-3">
                                    Enquiry Form</h4>
                                <form id="enquiry-form" action="" method="post">
                                    @csrf
                                    <input type="hidden" name="type" id="type" value="general">
                                    <!-- Name -->
                                    <div class="mb-2">
                                        <input type="text" class="form-control name_value" id="traveller_name"
                                            name="traveller_name" placeholder="Your Name"
                                            value="{{ old('traveller_name') }}" required>
                                    </div>

                                    <!-- Mobile Number -->
                                    <div class="mb-2">
                                        <input type="tel" class="form-control tel_value" name="mobile_no" id="mobile_no"
                                            placeholder="Your Mobile Number" value="{{ old('mobile_no') }}" required
                                            minlength="10" maxlength="10" pattern="[0-9]{10,15}"
                                            title="Please enter a valid phone number (minimum 10 digits)">
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-2">
                                        <input type="email" class="form-control email_value" name="email_id"
                                            id="email_id" value="{{ old('email_id') }}" placeholder="Your Email Address"
                                            required>
                                    </div>

                                    <!-- Message -->
                                    <div class="mb-2">
                                        <textarea class="form-control message_value" name="message" id="message"
                                            rows="3" placeholder="Message" required>{{ old('message') }}</textarea>
                                    </div>

                                    <div class="text-center mt-3">
                                        <button type="submit" id="enquirySubmit"
                                            class="btn btn-lg button-29 text-center">
                                            Enquiry Now
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <b><span style="color:red;" id="error_messagess"></span></b>
                                        <b><span style="color:green;" id="success_messagess"></span></b>
                                    </div>
                                </form>
                            </div>
                        </aside>
                        <aside id="block-2" class="widget mb-5 p-3 widget_block widget_search">
                            <div class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
                                <label class="wp-block-search__label  fw-semibold  fs-4 small-cnt-color"
                                    for="wp-block-search__input-1">Search</label>
                                <div class="wp-block-search__inside-wrapper ">
                                    <input class="wp-block-search__input search-field" autocomplete="off"
                                        id="search-blog" placeholder="Search blog by title..." type="search">

                                    <ul id="search-results" class="searchinfo">
                                    </ul>
                                </div>
                            </div>
                        </aside>
                        <aside id="block-3" class="widget mb-5 p-3 widget_block">
                            <div class="wp-block-group">
                                <div
                                    class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                    <h2 class="wp-block-heading fw-semibold  fs-4 small-cnt-color">Recent Posts</h2>
                                    <ul class="wp-block-latest-posts__list wp-block-latest-posts ps-2" type="none">
                                        @foreach ($recentBlogs as $blog)
                                        <li>
                                            <a class="wp-block-latest-posts__post-title anchor-text-clr"
                                                href="{{ route('blog-details', ['slug' => $blog->slug]) }}">{{ $blog->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </aside>
                        <aside id="block-4" class="widget mb-5 p-3 widget_block">
                            <div class="wp-block-group">
                                <div
                                    class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                    <h2 class="wp-block-heading fw-semibold  fs-4 small-cnt-color">Categories</h2>
                                    <div class="no-comments wp-block-latest-comments">
                                        <div class="px-3">
                                            @foreach ($currentBlog->blogCategories as $category)
                                            <div class="d-flex justify-content-between">
                                                <ul type="none" class="mb-0 ps-0 ">
                                                    <li style="border-bottom: none"><a
                                                            href="{{ route('blog-by-category', ['category_slug' => $category->category_slug]) }}"
                                                            class="anchor-text-clr">{{ $category->category }}</a>
                                                    </li>
                                                </ul>
                                                {{-- <p>(02)</p> --}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <aside id="block-4" class="widget mb-5 p-3 widget_block">
                            <div class="wp-block-group">
                                <div
                                    class="wp-block-group__inner-container is-layout-flow wp-block-group-is-layout-flow">
                                    <h2 class="wp-block-heading fw-semibold  fs-4 small-cnt-color">Tags</h2>
                                    <div class="no-comments wp-block-latest-comments">
                                        
                                        <ul type="none" style="column-count: 2">
                                            @foreach (json_decode($currentBlog->tags ?? '[]', true) as $tag)
                                            <li>
                                                <a href="#" class="anchor-text-clr">{{ $tag }}</a>
                                            </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
    </section>
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <form id="review-form" action="{{ route('store.blog.review') }}" method="post"
                        class="review-form-div p-4  form-dssg">
                        @csrf
                        <h4 class=" fw-semibold small-cnt-color">Write Your Comment</h4>
                        <input type="hidden" name="blog_id" value="{{ $currentBlog->id }}">
                        <div class="form-group">
                            <label for="name" class="fw-semibold">Name:</label>
                            <input class="form-control" type="text" placeholder="Name" name="name" id="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="city" class="fw-semibold">City:</label>
                            <input class="form-control" type="text" placeholder="City" name="city" id="city" value="">
                        </div>
                        <div class="form-group">
                            <label for="email" class="fw-semibold">Email:</label>
                            <input class="form-control" type="text" placeholder="Email" name="email" id="email"
                                value="">
                        </div>
                        <div id="rating">
                            <label class="control-label fw-semibold" for="rating"
                                style="color: black !important;">Choose Rating:</label>
                            <br>
                            @for ($i = 1; $i <= 5; $i++) <i class="bi bi-star-fill star-icon starpkg"
                                data-value="{{ $i }}"></i>
                                @endfor
                                @error('rating')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="">

                        <div class="form-group">
                            <label class="control-label fw-semibold" for="review">Your Comment:</label>
                            <textarea class="form-control" rows="5" placeholder="Your Reivew" name="review"
                                id="review"></textarea>
                            <span id="reviewInfo" class="help-block pull-right">
                            </span>

                        </div>
                        <a href="#" id="submit" class="button-29  fs-6">Post A Comment</a>
                    </form>

                </div>

            </div>
        </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="comments-area">
                    <h3 class="comments-title heading-clr">({{ $currentBlog->reviews->count() }}) Comments:</h3>
                    <ul class="" type=none>
                        @if ($currentBlog->reviews->isNotEmpty())
                        @foreach ($currentBlog->reviews->reverse()->take(4) as $blogReview)
                        <hr>
                        <li class="comment">
                            <article class="comment-body">
                                @for ($i = 1; $i <= (int) $blogReview->rating; $i++)
                                    <i class="fa fa-star starpkg text-warning"></i>
                                    @endfor
                                    <div class="comment-content">
                                        <h6 class="comment-author"><i class="fa-solid fa-circle-user text-primary-color"
                                                style="color: var(--main-color)"></i>&nbsp;{{ $blogReview->name }},
                                            {{ $blogReview->city }}
                                        </h6>

                                        <div class="comment-meta">
                                            <div class="comment-metadata">
                                                <div>
                                                    <span>
                                                        <i class="far fa-calendar-alt text-primary-color mrr-5"
                                                            style="color: var(--main-color)"></i>
                                                        {{ $blogReview->created_at->format('F d, Y') }} at
                                                        <i class="far fa-clock text-primary-color mrl-10 mrr-5 "
                                                            style="color: var(--main-color)"></i>
                                                        {{ $blogReview->created_at->format('h:i A') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="comment-text">
                                            {{ $blogReview->review }}
                                        </p>
                                    </div>
                            </article>

                        </li>
                        @endforeach
                        @else
                        <li>No reviews available.</li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </section>


    @push('scripts')
    <script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(document).ready(function() {
        $('.bi-star-fill').hover(function() {
            $(this).prevAll().addBack().css('color', '#ffcc00');
        }, function() {
            $('.bi-star-fill').css('color', 'gray');
            var rating = $('#rating-value').val();
            if (rating) {
                $('.bi-star-fill').each(function() {
                    if ($(this).data('value') <= rating) {
                        $(this).css('color', '#ffcc00');
                        $('label[for="rating"]').css('color', 'rgb(68, 71, 68)');
                    }
                });
            }
        });

        $('.bi-star-fill').on('click', function() {
            var rating = $(this).data('value');
            $('#rating-value').val(rating);
            $('.bi-star-fill').css('color', 'gray'); // Reset color for all stars
            $(this).prevAll().addBack().css('color', '#ffcc00'); // Change color for selected stars

            $('label[for="rating"]').css('color', 'rgb(68, 71, 68)');
        });

        $('#submit').on('click', function(e) {
            e.preventDefault();

            var formData = {
                blog_id: $('input[name="blog_id"]').val(),
                rating: $('#rating-value').val(),
                review: $('#review').val(),
                name: $('#name').val(),
                city: $('#city').val(),
                email: $('#email').val(),
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                type: 'POST',
                url: $('#review-form').attr('action'),
                data: formData,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#review-form')[0].reset();
                        $('.bi-star').css('color', 'grey');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        alert('Error submitting review.');
                    }
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        // Trigger search as the user types in the search box
        $('#search-blog').on('keyup', function() {
            var query = $(this).val(); // Get the search term from the input

            // Only send the AJAX request if the user has typed something
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('search.blog') }}", // Route to the search method
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        // Clear previous search results
                        $('#search-results').empty()
                            .show(); // Clear and show the results list

                        // If there are results, display them
                        if (data.length > 0) {
                            $.each(data, function(index, blog) {
                                // Generate dynamic URL for each blog
                                var blogUrl =
                                    "{{ route('blog-details', ':slug') }}".replace(
                                        ':slug', blog.slug);

                                // Append the search result to the dropdown list
                                $('#search-results').append(
                                    '<li style="padding: 5px; cursor: pointer; border-bottom:1px solid black;"><a href="' +
                                    blogUrl +
                                    '" style="text-decoration: none; color: #000;">' +
                                    blog.title + '</a></li>');
                            });
                        } else {
                            $('#search-results').append(
                                '<li style="padding: 5px; color:black;">No results found</li>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching results:", error);
                    }
                });
            } else {
                // Clear the results if the search input is empty
                $('#search-results').empty().hide();
            }
        });

        // Hide the dropdown if the user clicks outside
        $(document).click(function(event) {
            if (!$(event.target).closest('#search-blog, #search-results').length) {
                $('#search-results').hide();
            }
        });
    });
    </script>
    @endpush
    @endsection