@extends('front.layouts.main')

@php
    $page = request()->get('page', 1);
    $categorySlug = Request::segment(2);
    $pageSuffix = ($page > 1) ? ' - Page ' . $page : '';
    $canonicalUrl = url()->current();
    if ($page > 1) {
        $canonicalUrl .= '?page=' . $page;
    }
@endphp

@section('meta_title', ucfirst(str_replace('-', ' ', $categorySlug)) . ' - Filter Blogs By Category' . $pageSuffix)
@section('meta_description', 'You can filter the blogs according to different categories like ' . ucfirst(str_replace('-', ' ', $categorySlug)) . $pageSuffix)
@section('links', $canonicalUrl)

@section('content')
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
    </style>
    <main class="contact">
        <section class="mt-5 pt-4 breadcrumbs">
            <div class="container">
                <div class="row mt-5 margin-on-mobile">
                    <h1 class="col text-light fw-semibold fs-1 text-on-mobile">Blog</h1>
                    <h2 class="text-light fs-5 text-on-mobile-h5">
                        <a href="/">Home</a>&emsp;<span>/&emsp;Blog</span>
                    </h2>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row gx-3 gy-2">
                            @forelse ($blogs??[] as $blog)
                                <div class="col-md-6 col-sm-12 mb-2">
                                    <div class="card" style="border: 1px solid rgb(168, 165, 165);">
                                        <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                                            <img src="{{ asset($blog->cover_image_url) }}" height="182"
                                                alt="{{ $blog->title }}" class="card-img-top">
                                        </a>
                                        <div class="card-body card-body-padding">
                                            <div class="row d-flex justify-content-center m-0 p-0">
                                                <div class="col m-0 pb-1 px-0"><i
                                                        class="fa-solid fa-circle-user small-cnt-color"></i>&nbsp;{{ $blog->author_name }}
                                                </div>
                                                <div class="col m-0 pb-1 px-0"><i
                                                        class="fa-regular fa-calendar-days small-cnt-color"></i>&nbsp;{{ $blog->created_at->format('F d, Y') }}
                                                </div>
                                            </div>
                                            <h5 class="card-title mt-1 "><a class="small-cnt-color fw-semibold"
                                                    href="{{ route('blog-details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                            </h5>
                                            <p class="card-text">{!! \Str::words($blog->description, 20, '...') !!}</p>
                                            <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}"
                                                class="btn-blogs btn--with-icon"><i
                                                    class="btn-icon fa fa-long-arrow-right"></i>READ MORE</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h2>Blogs Not Available.</h2>
                            @endforelse
                            <div class="pagination-container">
                                <p>
                                    <b>
                                        Total records:
                                        {{ $blogs->total() }},
                                        Displaying records
                                        {{ $blogs->firstItem() }}
                                        to
                                        {{ $blogs->lastItem() }}
                                        of {{ $blogs->total() }}
                                    </b>
                                </p>
                                {{ $blogs->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div id="sidebar">
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
                                        <h2 class="wp-block-heading fw-semibold  fs-4 small-cnt-color">Popular Posts</h2>
                                        <ul class="wp-block-latest-posts__list wp-block-latest-posts ps-2" type="none">
                                            @forelse ($blogs->take(4)??[] as $blog)
                                                <li><a class="wp-block-latest-posts__post-title anchor-text-clr"
                                                        href="{{ route('blog-details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                                </li>
                                            @empty
                                                <h2>Blogs Not Available.</h2>
                                            @endforelse
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
                                                @foreach ($allCategories as $cat)
                                                    @if (is_object($cat) && isset($cat->category_slug))
                                                        <div class="d-flex justify-content-between">
                                                            <ul type="none" class="mb-0 ps-0">
                                                                <li style="border-bottom: none"><a
                                                                        href="{{ route('blog-by-category', ['category_slug' => $cat->category_slug]) }}"
                                                                        class="anchor-text-clr">{{ $cat->category }}</a>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    @else
                                                        <li>Not available category</li>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </aside>
                        </div>
                    </div>
                </div>
        </section>
    </main>

    @push('scripts')
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
