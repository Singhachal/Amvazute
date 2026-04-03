@extends('front.layouts.main')
@section('content')
    <style>
        .card-img-top {
            height: 300px;
        }
    </style>
    <section class="difference-section py-0 mb-0">
        {{-- <div class="container py-5 ">
            <div class="row justify-content-center text-14">
                <div class="col-lg-12 col-md-12">
                    <div class="swiper mmySwiperDifference">
                        <div class="swiper-wrapper">
                             Slide 1 
                            <div class="swiper-slide">
                                <img src="{{ asset('front/asset/img/home/Frame1.png') }}" class="card-img-top"
                                    alt="Shirt Soft Cotton" height="350px" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('front/asset/img/home/Frame2.png') }}" class="card-img-top"
                                    alt="Shirt Soft Cotton" height="350px" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('front/asset/img/home/Frame3.png') }}" class="card-img-top"
                                    alt="Shirt Soft Cotton" height="350px" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('front/asset/img/home/Frame4.png') }}" class="card-img-top"
                                    alt="Shirt Soft Cotton" height="350px" />
                            </div>
                        </div>

                         Navigation & Pagination 
                        <div class="swiper-button-next swiper-button-next-one"></div>
                        <div class="swiper-button-prev swiper-button-prev-one"></div>
                        <div class="swiper-pagination d-none"></div>
                    </div>
                </div>
                <div class="col-lg-12 text-14 mt-2 d-flex justify-content-between">
                    <div>
                        <span class="badge bg-info-color ">City & Infrastructure</span>
                        <span>800m away | 9 min ago by </span>
                        <span><b>@irina_s</b> </span>
                        <a href="/map" class="fw-semibold text-decoration-underline text-dark">| Get Map View</a>
                    </div>
                    <div class="text-14">
                        <span><i class="fa-solid fa-thumbs-up text-warning"></i>&nbsp;152
                            Likes</span>&emsp;
                        <span><i class="fa-solid fa-comments text-success"></i>&nbsp;4
                            Comments</span>&emsp;
                        <a class="border-0 text-dark" href="eventdetail">
                            <i class="fa-solid fa-share-from-square fs-6 text-muted"></i>share
                        </a>&emsp;
                        <a class="border-0 text-dark" href="eventdetail">
                            <i class="fa-regular fa-flag fs-6 text-dark"></i>report
                        </a>
                    </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <h1 class="heading fs-5">Blocked sidewalk on Str. Polonă. Be careful walking around here.</h1>
                    <p>This post was shared to keep the community aware of a real-time issue in the area. Whether it’s a
                        hazard, a helpful tip, or a local moment, every post on AM VAZUT helps people nearby stay informed
                        and make smarter decisions on the go. By contributing what you see, you’re not just sharing
                        information — you’re actively participating in building a more alert, aware, and responsive
                        environment. Feel free to react, share your own update, or add helpful details in the comments.
                        Every interaction counts, and together, we build a safer and more connected neighborhood where
                        everyone looks out for each other.</p>
                </div>

            </div>
        </div> --}}
        <div class="container py-5">
            <div class="row justify-content-center text-14">
                <div class="col-lg-12 col-md-12">
                    <div class="swiper mmySwiperDifference">
                        <div class="swiper-wrapper">
                            {{-- @forelse($event->media as $media)
                                <div class="swiper-slide">
                                    <img src="{{ asset('admin/uploads/event/' . $media->media_path) }}" class="card-img-top"
                                        alt="{{ $event->title }}" height="350px" />
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <img src="{{ asset('front/asset/img/home/default.png') }}" class="card-img-top"
                                        alt="No Image" height="350px" />
                                </div>
                            @endforelse --}}
                            @php
                                // Check if event has media in EventMedia table
                                $mediaItems = $event->media->count() ? $event->media : collect();
                            @endphp

                            @if ($mediaItems->isNotEmpty())
                                @foreach ($mediaItems as $media)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('admin/uploads/event/' . $media->media_path) }}"
                                            class="card-img-top" alt="{{ $event->title }}" height="350px" />
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide">
                                    @if ($event->media_path)
                                        <img src="{{ asset('admin/uploads/event/' . $event->media_path) }}"
                                            class="card-img-top" alt="{{ $event->title }}" height="350px" />
                                    @else
                                        <img src="{{ asset('front/asset/img/home/default.png') }}" class="card-img-top"
                                            alt="No Image" height="350px" />
                                    @endif
                                </div>
                            @endif

                        </div>

                        <!-- Navigation & Pagination -->
                        <div class="swiper-button-next swiper-button-next-one"></div>
                        <div class="swiper-button-prev swiper-button-prev-one"></div>
                        <div class="swiper-pagination d-none"></div>
                    </div>
                </div>

                <!-- Keep this part static -->
                <div class="col-lg-12 text-14 mt-2 ">
                    <div class="row d-flex justify-content-between">
                    <div class="col-md-6 col-12">
                        <span class="badge bg-info-color ">{{ $event->label }}</span>
                        {{-- <span>5km | 2 hours</span> --}}
                        <span id="distanceTime">Loading...</span>
                        <span><b>{{ $event->user->name ?? 'Unknown' }}</b></span>
                        {{-- <a href="/map" class="fw-semibold text-decoration-underline text-dark">| Get Map View</a> --}}
                        <a href="{{ route('events.map.single', $event->id) }}"
                            class="fw-semibold text-decoration-underline text-dark">| Get Map View</a>

                    </div>
                    <div class="text-14 col-md-6 col-12 mt-md-1 mt-2 text-sm-end">
                        <span class="btn-like" data-id="{{ $event->id }}">
                            <i class="fa-solid fa-thumbs-up {{ $liked ? 'text-danger' : 'text-warning' }}"></i>
                            <span class="like-count">{{ $totalLikes }}</span> Likes
                        </span>
                        &nbsp;
                        <span><i class="fa-solid fa-comments text-success"></i>&nbsp;{{ $commentCount }}
                            Comments</span>&emsp;
                        {{-- <a class="border-0 text-dark" href="">
                            <i class="fa-solid fa-share-from-square fs-6 text-muted"></i>share
                        </a>&emsp; --}}
                        <a href="javascript:void(0);"
                            onclick="shareEvent('{{ $event->title }}', '{{ url('eventdetail/' . $event->id) }}')"
                            class="border-0 text-dark">
                            <i class="fa-solid fa-share-from-square fs-6 text-muted"></i> Share
                        </a>&emsp;

                        {{-- <a class="border-0 text-dark" href="eventdetail">
                            <i class="fa-regular fa-flag fs-6 text-dark"></i>report
                        </a> --}}
                    </div>
                </div>
            </div>
                <!-- Only description is dynamic -->
                <div class="col-lg-12 mt-4">
                    <h1 class="heading fs-5">{{ $event->title }}</h1>
                    <p>{{ $event->description }}</p>
                </div>
            </div>
        </div>

    </section>
    <section class="my-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="heading f6 py-3" style="font-size: 18px;">Comments</h2>
                </div>
            </div>
            <div class="row g-4">
                @forelse($comments as $comment)
                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card bg-white p-3 rounded">
                            <div class="d-flex align-items-center mb-2">
                                <h3 class="fs-6 text-14">{{ $comment->created_at->diffForHumans() }}</h3>
                            </div>

                            <p class="m-0 text-14 fw-bold">{{ $comment->comment }}</p>
                            <h3 class="fs-6 mt-2 text-14">@ {{ $comment->user->name }}</h3>
                        </div>
                    </div>
                @empty
                    <p>No comments yet.</p>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <h2 class="heading f6 py-3" style="font-size: 18px;">Join the conversation</h2>

                    <form action="{{ route('post.comment', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" rows="5" placeholder="Write a comment.." required></textarea>
                        </div>
                        <button class="btn-primary-hero" type="submit">Post Comment</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Slider One
                new Swiper('.mmySwiperDifference', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next-one',
                        prevEl: '.swiper-button-prev-one',
                    },
                });
            });
        </script>

        <!-- <script>
            if (!window.location.search.includes("lat=")) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const newUrl = window.location.pathname + "?lat=" + lat + "&lng=" + lng;
                    window.location.href = newUrl;
                });
            }
        </script> -->

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
            function shareEvent(title, url) {
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        text: "Check out this event: " + title,
                        url: url
                    }).catch(err => console.log("Error sharing:", err));
                } else {
                    // Fallback for browsers that don't support Web Share API
                    let shareText = title + " - " + url;
                    navigator.clipboard.writeText(shareText).then(() => {
                        alert("Link copied! You can paste it anywhere.");
                    });
                }
            }
        </script>

        <script>
document.addEventListener("DOMContentLoaded", function () {

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            let eventLat = "{{ $event->latitude }}";
            let eventLng = "{{ $event->longitude }}";

            $.ajax({
                url: "{{ route('get.distance') }}",
                type: "POST",
                data: {
                    lat: lat,
                    lng: lng,
                    eventLat: eventLat,
                    eventLng: eventLng,
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    $("#distanceTime").text(res.distance + " | " + res.duration);
                },
                error: function () {
                    $("#distanceTime").text("N/A");
                }
            });

        }, function () {
            $("#distanceTime").text("Location blocked");
        });

    } else {
        $("#distanceTime").text("No GPS");
    }
});
</script>

    @endpush
@endsection
