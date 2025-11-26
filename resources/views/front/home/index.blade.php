@extends('front.layouts.main')
@section('content')
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

    <main>
        <section id="banner-images">
            <div class="container">
                <div class="row hero-content">
                    <div class="col-lg-6">
                        <div class="hero-text">
                            <h1>
                                {{ __('messages.banner_title') }}
                                <span class="highlight-text">{{ __('messages.banner_short_desc') }}</span>
                            </h1>
                            <p class="hero-description">
                                {{ __('messages.banner_description') }}</p>
                            <div class="hero-buttons m-sm-auto">
                                <a href="{{ url('create-post') }}" class="btn-primary-hero"
                                    style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Capture the Moment&nbsp;&nbsp;<i
                                        class="fa-solid fa-camera text-white"></i></a>
                                <a href="/event" class="btn-demo ">View Live Alerts</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 left-div">
                        <img src="{{ asset('front/asset/img/home/Banner-Phone.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center ">
                        <h2 class="heading">{!! __('messages.heading_title') !!}
                        </h2>
                        <div class="d-flex justify-content-center">
                            <p class="text-14 width-define">{{ __('messages.heading_description') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-3 col-sm-6 ">
                        <div class="stat-card  bg-white p-3  h-100 rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-regular fa-camera fs-5 text-primary "></i>&emsp;
                                {{-- <i class="bi bi-people "></i> --}}
                                <h3 class="fs-6 fw-bold">{{ __('messages.sport_title') }}</h3>
                            </div>

                            <p class=" m-0 text-14">{{ __('messages.sport_description') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card  bg-white p-3 h-100 rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-solid fa-location-dot fs-5 text-warning "></i>&emsp;
                                <h3 class="fs-6 fw-bold">{{ __('messages.capture_title') }}</h3>
                            </div>

                            <p class=" m-0 text-14">{{ __('messages.capture_description') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card  bg-white p-3 h-100 rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-regular fa-file-lines fs-5 text-primary "></i>&emsp;
                                <h3 class="fs-6 fw-bold">{{ __('messages.share_title') }} </h3>
                            </div>

                            <p class=" m-0 text-14">{{ __('messages.share_description') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card  bg-white p-3 h-100 rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-solid fa-users-line fs-5 text-warning "></i>&emsp;
                                <h3 class="fs-6 fw-bold">{{ __('messages.others_title') }}</h3>
                            </div>

                            <p class=" m-0 text-14">{{ __('messages.others_description') }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-12 d-sm-flex justify-content-between d-block">
                        <div>
                            <h2 class=" heading mb-3">{!! __('messages.event_title') !!}</h2>
                            <div class="d-flex justify-content-center">
                                <p class="text-14 mb-4 width-define">{{ __('messages.event_description') }}</p>
                            </div>
                        </div>
                        <div>
                            {{-- <button type="button" class="btn-primary-hero mt-sm-4">Read More</button> --}}
                            <a href="{{ url('event') }}">
                                <button type="button" class="btn-primary-hero mt-sm-4">View More</button>
                            </a>

                        </div>
                    </div>
                    <div class="swiper mySwiper">
                        {{-- <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <div class="card product-card h-100">
                                    <span class="badge bg-info-color position-absolute top-0 end-0 m-3">Everyday
                                        Moments</span>
                                    <img src="{{ asset('front/asset/img/home/Frame1.png') }}" class="card-img-top"
                                        alt="Shirt Soft Cotton">
                                    <div class="card-body">
                                        <p class="mb-2">300m away | 15 min ago</p>
                                        <h2 class="card-title fs-5">
                                            <a href="#">Beautiful morning at Herastrau Park. Fresh air and good
                                                vibes.</a>
                                        </h2>
                                        <p>Enjoying the outdoors? This local capture reminds us to take a breath and
                                            appreciate.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-14">
                                                <span><i class="fa-solid fa-thumbs-up text-warning"></i>&nbsp;152
                                                    Likes</span>&emsp;
                                                <span><i class="fa-solid fa-comments text-success"></i>&nbsp;4
                                                    Comments</span>
                                            </div>
                                            <a class="border-0" href="eventdetail">
                                                <i class="fa-solid fa-share-from-square fs-6 text-dark"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="swiper-wrapper">
                            @foreach ($events as $event)
                                <div class="swiper-slide">
                                    <div class="card product-card h-100">
                                        <span class="badge bg-info-color position-absolute top-0 end-0 m-3">
                                            {{ $event->label ?? 'Event' }}
                                        </span>

                                        <img src="{{ asset('admin/uploads/event/' . $event->media_path) }}"
                                            class="card-img-top" alt="{{ $event->title }}">

                                        <div class="card-body">
                                            <p class="mb-2">
                                                <span id="distance-{{ $event->id }}">Loading...</span> |
                                                {{ $event->created_at->diffForHumans() }}
                                            </p>

                                            <h2 class="card-title fs-5">
                                                <a href="{{ url('eventdetail/' . $event->id) }}">{{ $event->title }}</a>
                                            </h2>

                                            <p>{{ Str::words($event->description, 20, '...') }}
                                                <a href="{{ url('eventdetail/' . $event->id) }}"
                                                    class="read-more-link mt-2">
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



                        <!-- Navigation & Pagination -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination d-none"></div>
                    </div>
                </div>
            </div>
        </section>
        <section style="background: black; color:white;" class="position-relative">
            <div class="container">
                <div class="row py-5">
                    <div class="col-lg-6">
                        <h2 class="heading text-white">{!! __('messages.post_title') !!}</h2>
                        <div class="d-flex justify-content-center">
                            <p class="text-14">{{ __('messages.event_description') }}
                            </p>
                        </div>
                        <ul class="ps-0">
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.post_point1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.post_point2') }}
                                </p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.post_point3') }}
                                </p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.post_point4') }}</p>
                            </li>
                        </ul>
                        <a type="button" href="{{ url('map-view') }}" class="btn-primary-hero">See Live Map </a>

                    </div>
                    <div class="col-lg-6 ">
                        <img src="{{ asset('front/asset/img/home/Group9.png') }}" alt="" class="img-left-right">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row g-4 mt-1">
                    <div class="col-lg-12 text-center ">
                        <h2 class="heading ">{!! __('messages.promise_title') !!}
                        </h2>
                        <div class="d-flex justify-content-center">
                            <p class="text-14 width-define">{!! __('messages.promise_description') !!} </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="stat-card  bg-white p-3  rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-regular fa-camera fs-5 text-primary "></i>&emsp;
                                {{-- <i class="bi bi-people "></i> --}}
                                <h3 class="fs-6 fw-bold">{{ __('messages.safety_title') }}</h3>
                            </div>

                            <p class=" text-14">{{ __('messages.safety_description') }}
                            </p>
                            <ul class="ps-0 text-14">
                                <li class="d-flex mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.safety_point1') }}</p>
                                </li>
                                <li class="d-flex mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.safety_point2') }}.</p>
                                </li>
                                <li class="d-flex mb-0 mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.safety_point3') }}. </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="stat-card  bg-white p-3  rounded">
                            <div class="d-flex align-item-center mb-2">
                                <i class="fa-solid fa-triangle-exclamation fs-5 text-danger "></i>&emsp;
                                <h3 class="fs-6 fw-bold">{{ __('messages.trust_title') }}</h3>
                            </div>
                            <p class=" text-14">{{ __('messages.trust_description') }}</p>
                            <ul class="ps-0 text-14">
                                <li class="d-flex mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.trust_point1') }}</p>
                                </li>
                                <li class="d-flex mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.trust_point2') }}</p>
                                </li>
                                <li class="d-flex mb-0 mb-2">
                                    <img src="/front/asset/img/home/arrow.png" alt="right icon" height="20px">&nbsp;
                                    <p class=" m-0">{{ __('messages.trust_point3') }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12 d-flex justify-content-center ">
                        <a href="{{ asset('create-post') }}" class="btn-primary-hero"
                            style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Start Posting &nbsp;&nbsp;<i
                                class="fa-solid fa-camera text-white"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row ">
                    <div class="col-lg-6">
                        <h2 class="heading">{!! __('messages.home_about_title') !!}</h2>
                        <div class="d-flex justify-content-center">
                            <p class="text-14 ">{{ __('messages.home_about_description') }}
                            </p>
                        </div>
                        <ul class="ps-0 text-14">
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.home_about_point1') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.home_about_point2') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.home_about_point3') }}</p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.home_about_point4') }} </p>
                            </li>
                            <li class="d-flex">
                                <img src="/front/asset/img/home/arrow.png" alt="right icon" height="22px">&nbsp;
                                <p>{{ __('messages.home_about_point5') }}</p>
                            </li>
                        </ul>
                        {{-- <button type="button" class="btn-primary-hero">Join the Community</button> --}}
                        <button type="button" class="btn-primary-hero"
                            onclick="document.getElementById('social-footer').scrollIntoView({ behavior: 'smooth' });">
                            Join the Community
                        </button>


                    </div>
                    <div class="col-lg-6 ">
                        <img src="{{ asset('front/asset/img/home/Rectangle5.png') }}" alt="" width="100%"
                            height="400px " class="img-responsive-here">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-center  heading mb-3">{!! __('messages.home_blog') !!}
                        </h2>
                        <div class="d-flex justify-content-center">

                            <p class="text-center mb-4 text-14 width-define">{{ __('messages.home_desc') }}</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="/front/asset/img/home/Frame5.png" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h5 class="card-title">10 Tips for Productive Remote Work</h5>
                                <p class="card-text">Learn how to stay focused and efficient while working from home with
                                    these
                                    expert tips.</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn-primary-hero">Read More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="/front/asset/img/home/Frame6.png" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h5 class="card-title">The Future of Artificial Intelligence</h5>
                                <p class="card-text">Explore the potential impact of AI on various industries and our daily
                                    lives.
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn-primary-hero">Read More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="/front/asset/img/home/Frame7.png" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h5 class="card-title">Sustainable Living: Small Changes, Big Impact</h5>
                                <p class="card-text">Discover easy ways to reduce your carbon footprint and live a more
                                    eco-friendly
                                    life.</p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn-primary-hero">Read More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($blogs as $blog)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ $blog->cover_image_url ?? asset('front/asset/img/default-blog.png') }}"
                                    class="card-img-top" alt="{{ $blog->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit(strip_tags($blog->description), 100) }}
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ url('blog/' . $blog->slug) }}" class="btn-primary-hero">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
        <section style="background-color: black;" class="position-relative">
            <div class="container py-5">
                <div class="row d-flex justify-content-center">

                    <div class="col-lg-5">
                        <h2 class="text-white fs-3 mb-3">{{ __('messages.home_post_title') }}</h2>
                        <p class="text-white text-14">{{ __('messages.home_post_description') }}</p>
                        <div class="hero-buttons m-sm-auto">
                            <a href="{{ url('register') }}" class="btn-primary-hero"
                                style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">Sign Up Now</a>
                            <a href="{{ url('/create-post') }}" class="btn-demo ">Create a Post</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img src="/front/asset/img/home/hand-holding.png" alt="" class="img-mic">
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
        <!-- Swiper JS -->

        <!-- Swiper JS (before </body>) -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: false,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // For responsiveness
                breakpoints: {
                    576: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    1200: {
                        slidesPerView: 4,
                    },
                }
            });
        </script>

        <script>
            document.querySelectorAll('.btn-like').forEach(btn => {
                btn.addEventListener('click', function() {
                    let userLoggedIn = @json(auth()->check()); // true if logged in
                    let eventId = this.dataset.id;
                    let icon = this.querySelector('i');
                    let countSpan = this.querySelector('span');

                    if (!userLoggedIn) {
                        // Show alert for guests
                        alert('You must be logged in to like this post!');
                        return; // stop execution
                    }

                    // Logged-in users: make AJAX call
                    fetch(`/event/${eventId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Update icon color and likes count
                            icon.classList.toggle('text-danger', data.liked);
                            icon.classList.toggle('text-warning', !data.liked);
                            btn.querySelector('span').innerText = data.total_likes + " Likes";
                        });
                });
            });
        </script>


        <script>
            function sharePost(url, title) {
                // Check if Web Share API is supported
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).then(() => {
                        console.log('Post shared successfully!');
                    }).catch((error) => {
                        console.log('Error sharing:', error);
                    });
                } else {
                    // Fallback: copy link to clipboard
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Link copied to clipboard: ' + url);
                    }).catch(() => {
                        alert('Share not supported on this browser.');
                    });
                }
            }
        </script>
        <script>
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = parseFloat(position.coords.latitude.toFixed(6));
                const lng = parseFloat(position.coords.longitude.toFixed(6));

                fetch(`/events?lat=${lat}&lng=${lng}`)
                    .then(res => res.json())
                    .then(data => console.log(data));
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                if (!navigator.geolocation) return;

                navigator.geolocation.getCurrentPosition(function(position) {

                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    fetch("{{ url('/home-distance') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                lat: lat,
                                lng: lng
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            Object.keys(data).forEach(function(id) {

                                let distElm = document.getElementById("distance-" + id);

                                if (!distElm) return;

                                distElm.innerHTML = data[id].distance ?? "N/A";
                            });
                        });
                });
            });
        </script>
    @endpush
@endsection
