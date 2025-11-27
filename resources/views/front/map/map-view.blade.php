@extends('front.layouts.main')
@section('content')
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .sidebar {
            /* height: 100vh; */
            overflow-y: auto;
            background-color: #000;
            /* padding: 1rem; */
        }

        .text-muted {
            color: gray !important;
        }

        .sidebar img {
            border-radius: 2px;

            height: 100px;
            width: 100px;
        }

        .post-card {
            background-color: transparent;
            border: none;
            color: #ccc;
            margin-bottom: 1rem;
        }

        .post-card:hover {
            background-color: #1a1a1a;
            cursor: pointer;
        }

        .map-container {
            height: 100vh;
            position: relative;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .map-marker {
            position: absolute;
            background: rgba(0, 0, 0, 0.85);
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            max-width: 200px;
            color: #fff;
        }

        /* Example marker positions */
        .marker-1 {
            top: 10%;
            left: 60%;
        }

        .marker-2 {
            top: 30%;
            left: 40%;
        }

        .marker-3 {
            bottom: 15%;
            left: 50%;
        }

        .post-card {
            background: transparent;
            border: none;
            margin-bottom: 1rem;
        }

        .post-card:hover {
            background: #1a1a1a;
            cursor: pointer;
        }

        #map {
            height: 100vh;
            width: 100%;
        }

        input::placeholder {
            color: #fff !important;
        }

        .form-select {
            font-size: 14px !important;
        }

        @media (max-width:576px) {
            .form-select {
                font-size: 12px !important;
            }
        }

        /* .leaflet-routing-container {
                display: none;
            } */

        .filter-bar .filter-button {
            background-color: #1a1a1a;
            /* default dark */
            color: #fff;
            border: none;
        }

        .filter-bar .filter-button:hover {
            background-color: #000;
            /* black on hover */
            color: #fff;
        }

        /* Sidebar scroll */
.sidebar {
    background-color: #000;
    overflow-y: auto;      /* enable vertical scrolling */
    height: calc(100vh - 40px); /* full viewport height minus some padding/margin */
    padding: 1rem;
}

/* Optional: smooth scroll */
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #555;
    border-radius: 3px;
}

    </style>
    <section class="">
        <div class="container-fluid">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar mt-5 mt-sm-1 p-3">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-0 text-white">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="search" class="form-control bg-dark text-white border-0"
                                placeholder="Search posts, places, or alerts...">
                        </div>
                    </div>
                    {{-- <div class="filter-bar mb-3 ">
                        <button class="filter-button">View posts within<i class="arrow-down"></i></button>
                        <button class="filter-button">Post Type <i class="arrow-down"></i></button>
                        <button class="filter-button">Sort By <i class="arrow-down"></i></button>
                    </div> --}}

                    <div class="filter-bar mb-3">
                        <select id="filter-distance" class="form-select filter-button">
                            <option value="">View posts within</option>
                            <option value="1">1 km</option>
                            <option value="5">5 km</option>
                            <option value="10">10 km</option>
                            <option value="20">20 km</option>
                        </select>

                        <select id="filter-type" class="form-select filter-button">
                            <option value="">Post Type</option>
                            @foreach (\App\Models\Event::distinct('label')->pluck('label') as $label)
                                <option value="{{ $label }}">{{ ucfirst($label) }}</option>
                            @endforeach
                        </select>

                        <select id="filter-sort" class="form-select filter-button">
                            <option value="latest">Sort By: Latest</option>
                            <option value="oldest">Sort By: Oldest</option>
                        </select>
                    </div>


                    {{-- <img src="/front/asset/img/home/Frame1.png" class="me-3" alt="" style="height:300px; width:100%;">
                    <div class="post-card d-flex">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Beautiful morning at herastrau Park. Fresh air and good vibes.</h6>
                            <p class="small">Enjoying the outdoors? This local capture reminds us to take a breath and appreciate the moment.</p>
                        </div>
                    </div> --}}
                    {{-- ✅ Latest Event Post --}}
                    @if ($latestEvent)
                        <img src="{{ asset('admin/uploads/event/' . $latestEvent->media_path) }}" class="me-3"
                            alt="{{ $latestEvent->title }}" style="height:300px; width:100%;">

                        <div class="post-card d-flex mt-2">
                            <div>
                                <small class="text-muted">
                                    <span id="latest-distance">--</span> |
                                    <span id="latest-time">--</span>
                                </small>

                                <h6 class="text-white mt-1">{{ $latestEvent->title }}</h6>
                                <p class="small">{{ $latestEvent->description }}</p>
                            </div>
                        </div>
                    @endif
                    @foreach ($otherEvents as $event)
                        <div class="post-card d-flex">
                            <img src="{{ asset('admin/uploads/event/' . $event->media_path) }}" class="me-3"
                                style="height:80px; width:80px; object-fit:cover;" alt="Event Image">

                            <div>
                                <small class="text-muted">
                                    <span id="distance-{{ $event->id }}">--</span> |
                                    <span id="time-{{ $event->id }}">--</span>
                                </small>


                                <h6 class="text-white mt-1">{{ $event->title }}</h6>
                                <p class="small">
                                    {{ \Illuminate\Support\Str::words($event->description, 20, '...') }}
                                    <a href="{{ url('eventdetail/' . $event->id) }}" class="text-info">Read more</a>
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Map -->
                <div class="col-lg-8 col-md-12 map-container">
                    {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18..." allowfullscreen></iframe>

                    <!-- Example markers -->
                    <div class="map-marker marker-1">Tried a shawarma from this tiny cart on Strada Franceza surprisingly
                        great!</div>
                    <div class="map-marker marker-2">Traffic light not working near Piata Romana. Drive with caution!</div>
                    <div class="map-marker marker-3">Blocked sidewalk on Str. Polona. Be careful walking around here.</div> --}}

                    <div id="eventMap" style="height:700px; width:100%;" allowfullscreen></div>

                </div>
            </div>
        </div>
    </section>




    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const map = new google.maps.Map(document.getElementById("eventMap"), {
                center: {
                    lat: 28.6139,
                    lng: 77.2090
                },
                zoom: 12
            });

            function addDotMarker(lat, lng, title) {
                new google.maps.Marker({
                    position: {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    },
                    map: map,
                    title: title,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 6,
                        fillColor: "#ff3333",
                        fillOpacity: 1,
                        strokeWeight: 2,
                        strokeColor: "#ffffff"
                    }
                });
            }

            @if ($latestEvent)
                addDotMarker("{{ $latestEvent->latitude }}", "{{ $latestEvent->longitude }}",
                    "{{ $latestEvent->title }}");
                map.setCenter({
                    lat: parseFloat("{{ $latestEvent->latitude }}"),
                    lng: parseFloat("{{ $latestEvent->longitude }}")
                });
            @endif

            @foreach ($otherEvents as $event)
                addDotMarker("{{ $event->latitude }}", "{{ $event->longitude }}", "{{ $event->title }}");
            @endforeach

        });
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(pos) {

                    let form = new FormData();
                    form.append("lat", pos.coords.latitude);
                    form.append("lng", pos.coords.longitude);
                    form.append("_token", "{{ csrf_token() }}");

                    fetch("{{ url('/ajax/get-distance') }}", {
                            method: "POST",
                            body: form
                        })
                        .then(res => res.json())
                        .then(data => {

                            if (data.latest) {
                                document.getElementById("latest-distance").innerText = data.latest
                                    .distance;
                                document.getElementById("latest-time").innerText = data.latest.duration;
                            }

                            data.others.forEach(ev => {
                                let d = document.getElementById("distance-" + ev.id);
                                let t = document.getElementById("time-" + ev.id);

                                if (d) d.innerText = ev.distance;
                                if (t) t.innerText = ev.duration;
                            });

                        });

                });
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function fetchFilteredEvents() {
                const distance = document.getElementById('filter-distance').value;
                const type = document.getElementById('filter-type').value;
                const sort = document.getElementById('filter-sort').value;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(pos) {
                        let form = new FormData();
                        form.append('lat', pos.coords.latitude);
                        form.append('lng', pos.coords.longitude);
                        form.append('distance', distance);
                        form.append('type', type);
                        form.append('sort', sort);
                        form.append('_token', '{{ csrf_token() }}');

                        fetch("{{ url('/ajax/filter-events') }}", {
                                method: 'POST',
                                body: form
                            })
                            .then(res => res.json())
                            .then(data => {
                                // Update sidebar
                                const sidebar = document.querySelector('.sidebar');
                                let html = '';

                                if (data.latest) {
                                    html += `
                        <img src="/admin/uploads/event/${data.latest.media_path}" class="me-3" style="height:300px; width:100%;">
                        <div class="post-card d-flex mt-2">
                            <div>
                                <small class="text-muted">${data.latest.distance} | ${data.latest.duration}</small>
                                <h6 class="text-white mt-1">${data.latest.title}</h6>
                                <p class="small">${data.latest.description}</p>
                            </div>
                        </div>`;
                                }

                                data.others.forEach(ev => {
                                    html += `
                        <div class="post-card d-flex">
                            <img src="/admin/uploads/event/${ev.media_path}" class="me-3" style="height:80px; width:80px; object-fit:cover;" alt="Event Image">
                            <div>
                                <small class="text-muted">${ev.distance} | ${ev.duration}</small>
                                <h6 class="text-white mt-1">${ev.title}</h6>
                                <p class="small">${ev.description.substring(0, 50)}... <a href="/eventdetail/${ev.id}" class="text-info">Read more</a></p>
                            </div>
                        </div>`;
                                });

                                sidebar.innerHTML = html;

                                // Update map
                                const map = new google.maps.Map(document.getElementById("eventMap"), {
                                    center: {
                                        lat: pos.coords.latitude,
                                        lng: pos.coords.longitude
                                    },
                                    zoom: 12
                                });

                                function addDotMarker(lat, lng, title) {
                                    new google.maps.Marker({
                                        position: {
                                            lat: parseFloat(lat),
                                            lng: parseFloat(lng)
                                        },
                                        map: map,
                                        title: title,
                                        icon: {
                                            path: google.maps.SymbolPath.CIRCLE,
                                            scale: 6,
                                            fillColor: "#ff3333",
                                            fillOpacity: 1,
                                            strokeWeight: 2,
                                            strokeColor: "#fff"
                                        }
                                    });
                                }

                                if (data.latest) {
                                    addDotMarker(data.latest.latitude, data.latest.longitude, data
                                        .latest.title);
                                }

                                data.others.forEach(ev => {
                                    addDotMarker(ev.latitude, ev.longitude, ev.title);
                                });

                            });
                    });
                }
            }

            // Add event listeners
            document.getElementById('filter-distance').addEventListener('change', fetchFilteredEvents);
            document.getElementById('filter-type').addEventListener('change', fetchFilteredEvents);
            document.getElementById('filter-sort').addEventListener('change', fetchFilteredEvents);

        });
    </script>
@endsection
