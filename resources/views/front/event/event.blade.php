@extends('front.layouts.main')
@section('content')
    <style>
        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: var(--bs-pagination-active-color);
            background-color: var(--main-color);
            border-color: var(--main-color);
        }

        .page-link {
            color: var(--main-color);
        }

       
      input, optgroup, select, textarea {
 
    border-radius: 4px !important;
    background: #fff !important;
    border: none;
        border: 1px solid #9f9c9c;
        font-size:15px;
    }
       @media(max-width:576px)
       {
        button, input, optgroup, select, textarea {
    height: 40px;
}
       }
    </style>

    <style>
        .card-img-top {
            height: 200px;
            /* Adjust to desired height */
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 0.5rem;
            /* match Bootstrap card rounding */
            border-top-right-radius: 0.5rem;
        }
    </style>
    <section class="difference-section py-0">
        <div class="container pt-5 ">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="contact-wrapper">
                        <div class="row g-0">
                            <div class="col-lg-12 text-center">
                                <h2 class="heading">{!! __('messages.event_post_title') !!}</h2>
                                <p style="font-size: 14px;">{!! __('messages.event_post_desc') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-12">
                    <div class="filter-bar">
                        <button class="filter-button">Date Range <i class="arrow-down"></i></button>
                        <button class="filter-button">Event Type <i class="arrow-down"></i></button>
                        <button class="filter-button">Location Radius <i class="arrow-down"></i></button>
                        <button class="filter-button">Sort By <i class="arrow-down"></i></button>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="filter-bar">
                        <form method="GET" action="{{ route('event') }}">
                            <div class="filter-bar">

                                <!-- Date Range -->
                                <input type="date" name="start_date" value="{{ request('start_date') }}">
                                <input type="date" name="end_date" value="{{ request('end_date') }}">

                                <!-- Event Type -->
                                <!-- Event Type -->
                                <select name="label">
                                    <option value="">All Types</option>
                                    @foreach ($labels as $label)
                                        <option value="{{ $label }}"
                                            {{ request('label') == $label ? 'selected' : '' }}>
                                            {{ ucfirst($label) }}
                                        </option>
                                    @endforeach
                                </select>


                                <!-- Location Radius -->
                                <select name="radius">
                                    <option value="">Any Distance</option>
                                    <option value="5" {{ request('radius') == 5 ? 'selected' : '' }}>5 km</option>
                                    <option value="10" {{ request('radius') == 10 ? 'selected' : '' }}>10 km</option>
                                    <option value="50" {{ request('radius') == 50 ? 'selected' : '' }}>50 km</option>
                                </select>

                                <!-- Sort By -->
                                <select name="sort_by">
                                    <option value="">Sort</option>
                                    <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Latest
                                    </option>
                                    <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest
                                    </option>
                                    <option value="nearest" {{ request('sort_by') == 'nearest' ? 'selected' : '' }}>Nearest
                                    </option>
                                </select>

                                <button type="submit" class="filter-button btn-dark" style="white-space: nowrap;">Apply Filters</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="row mt-4 g-4">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card product-card h-100">
                            <span class="badge bg-info-color position-absolute top-0 end-0 m-3">{{ $event->label }}</span>
                            <img src="{{ asset('admin/uploads/event/' . $event->media_path) }}" class="card-img-top"
                                alt="Event Image">
                            <div class="card-body">
                                <p class="mb-2">
                                    <span class="distance" data-lat="{{ $event->latitude }}"
                                        data-lng="{{ $event->longitude }}">Calculating...</span> |
                                    {{ \Carbon\Carbon::parse($event->reported_at)->diffForHumans() }}
                                </p>
                                <h2 class="card-title fs-5">
                                    <a href="#">{{ $event->title }}</a>
                                </h2>
                                <p>{{ Str::words($event->description, 20, '...') }}
                                    <a href="{{ url('eventdetail/' . $event->id) }}" class="read-more-link mt-2">
                                        Read More
                                    </a>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-14">
                                        <!-- Like button -->
                                        <span class="btn-like" data-id="{{ $event->id }}">
                                            <i
                                                class="fa-solid fa-thumbs-up {{ $event->likedByUser(auth()->id()) ? 'text-danger' : 'text-warning' }}"></i>
                                            <span class="like-count">{{ $event->likes()->count() }}</span>
                                            Likes
                                        </span>&nbsp;
                                        <span><i
                                                class="fa-solid fa-comments text-success"></i>&nbsp;{{ $event->comments_count }}
                                            Comments</span>
                                    </div>
                                    {{-- <a class="border-0" href="{{ url('eventdetail/' . $event->id) }}">
                                        <i class="fa-solid fa-share-from-square fs-6 text-dark"></i>
                                    </a> --}}
                                    <a class="border-0" href="#"
                                        onclick="sharePost('{{ url('eventdetail/' . $event->id) }}', '{{ $event->title }}'); return false;">
                                        <i class="fa-solid fa-share-from-square fs-6 text-dark"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- <div class="row mt-5">
                <div class="col-lg-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="bi bi-chevron-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="bi bi-chevron-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> --}}

            <div class="row mt-5">
                <div class="col-lg-12">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>


        </div>
    </section>
    <section style="background-color: black;" class="my-0 position-relative">
        <div class="container py-5">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-5">
                    <h2 class="text-white fs-3 mb-3">{{ __('messages.event_post_create_title') }}</h2>
                    <p class="text-white text-14">{{ __('messages.event_post_create_desc') }}.
                    </p>
                    <div class="hero-buttons m-sm-auto">
                        <a href="/register" class="btn-primary-hero"
                            style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Sign Up Now</a>
                        <a href="/create-post" class="btn-demo ">Create a Post</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img src="/front/asset/img/home/hand-holding.png" alt="" class="img-mic">
                </div>
            </div>
        </div>
    </section>

    <script>
        function haversine(lat1, lon1, lat2, lon2) {
            const R = 6371; // km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                document.querySelectorAll('.distance').forEach(function(span) {
                    const eventLat = parseFloat(span.dataset.lat);
                    const eventLng = parseFloat(span.dataset.lng);

                    const dist = haversine(userLat, userLng, eventLat, eventLng);
                    span.textContent = (dist * 1000 < 1000) ?
                        `${Math.round(dist * 1000)}m away` :
                        `${dist.toFixed(2)} km away`;
                });
            }, function(error) {
                console.error('Error getting location:', error);
            });
        } else {
            console.error('Geolocation not supported by this browser.');
        }
    </script>
@endsection
