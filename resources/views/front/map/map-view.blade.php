@extends('front.layouts.main')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .sidebar {
            height: 100vh;
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
    <form method="GET" action="{{ url()->current() }}">
        <input type="hidden" name="lat" value="{{ $userLat }}">
        <input type="hidden" name="lng" value="{{ $userLng }}">

        <!-- Distance Filter -->
        <select name="distance" class="form-select d-inline-block w-auto">
            <option value="">View posts within</option>
            <option value="500" {{ request('distance') == 500 ? 'selected' : '' }}>500 m</option>
            <option value="1000" {{ request('distance') == 1000 ? 'selected' : '' }}>1 km</option>
            <option value="5000" {{ request('distance') == 5000 ? 'selected' : '' }}>5 km</option>
            <option value="10000" {{ request('distance') == 10000 ? 'selected' : '' }}>10 km</option>
        </select>

        <!-- Post Type Filter -->
        <select name="type" class="form-select d-inline-block w-auto">
            <option value="">Post Type</option>
            <option value="alert" {{ request('type') == 'alert' ? 'selected' : '' }}>Alert</option>
            <option value="place" {{ request('type') == 'place' ? 'selected' : '' }}>Place</option>
            <option value="post" {{ request('type') == 'post' ? 'selected' : '' }}>Post</option>
        </select>

        <!-- Sort Filter -->
        <select name="sort" class="form-select d-inline-block w-auto">
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
        </select>

        <button type="submit" class="btn btn-sm btn-danger">Apply</button>
    </form>
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
                                    {{ $latestEvent->distance_text ?? '' }} |
                                    {{ $latestEvent->reported_at?->diffForHumans() ?? $latestEvent->created_at->diffForHumans() }}
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
                                    {{ $event->distance_text ?? '' }} |
                                    {{ $event->reported_at?->diffForHumans() ?? $event->created_at->diffForHumans() }}
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
                {{-- <div class="col-lg-8 col-md-12 map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18..." allowfullscreen></iframe>

                    <!-- Example markers -->
                    <div class="map-marker marker-1">Tried a shawarma from this tiny cart on Strada Franceza surprisingly
                        great!</div>
                    <div class="map-marker marker-2">Traffic light not working near Piata Romana. Drive with caution!</div>
                    <div class="map-marker marker-3">Blocked sidewalk on Str. Polona. Be careful walking around here.</div>
                </div> --}}
                <div class="col-lg-8 col-md-12 map-container" id="map-container">
                    <div id="map" style="width: 100%; height: 100vh;"></div>

                    {{-- Hidden marker divs for all events --}}
                    @if ($latestEvent)
                        <div class="map-marker" data-lat="{{ $latestEvent->latitude }}"
                            data-lng="{{ $latestEvent->longitude }}" data-type="latest">
                            <b>{{ $latestEvent->title }}</b><br>{{ $latestEvent->distance_text ?? '' }} away
                        </div>
                    @endif

                    @foreach ($otherEvents as $event)
                        <div class="map-marker" data-lat="{{ $event->latitude }}" data-lng="{{ $event->longitude }}"
                            data-type="other">
                            <b>{{ $event->title }}</b><br>{{ $event->distance_text ?? '' }} away
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                // Send location via POST (no URL exposure)
                $.ajax({
                    url: "{{ route('map') }}",
                    type: "POST",
                    data: {
                        latitude: lat,
                        longitude: lng,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $("#events-container").html(response);
                    }
                });
            }, function() {
                $("#events-container").html("<p>Location access denied.</p>");
            });
        } else {
            $("#events-container").html("<p>Geolocation not supported.</p>");
        }
    </script>

    <script>
        // Get user's location and reload page with query params
        window.onload = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    const urlParams = new URLSearchParams(window.location.search);
                    if (!urlParams.get('lat') || !urlParams.get('lng')) {
                        window.location.href = `/map-view?lat=${latitude}&lng=${longitude}`;
                    }
                });
            }
        };
    </script>

    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Map center: latest event first, else default
            const mapCenter = [
                {{ $latestEvent->latitude ?? 28.6139 }},
                {{ $latestEvent->longitude ?? 77.209 }}
            ];

            // Initialize map
            const map = L.map('map').setView(mapCenter, 13);

            // OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // User location marker (optional)
            @if ($userLat && $userLng)
                L.marker([{{ $userLat }}, {{ $userLng }}], {
                    title: 'You are here',
                    icon: L.icon({
                        iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    })
                }).addTo(map).bindPopup("<b>You are here</b>");
            @endif

            // Loop through all event marker divs
            document.querySelectorAll('.map-marker').forEach(function(markerDiv) {
                const lat = parseFloat(markerDiv.getAttribute('data-lat'));
                const lng = parseFloat(markerDiv.getAttribute('data-lng'));
                const popupText = markerDiv.innerHTML;
                const type = markerDiv.getAttribute('data-type');

                // Marker color
                let iconUrl = (type === 'latest') ?
                    'https://maps.google.com/mapfiles/ms/icons/red-dot.png' :
                    'https://maps.google.com/mapfiles/ms/icons/green-dot.png';

                // Add marker to map
                L.marker([lat, lng], {
                    icon: L.icon({
                        iconUrl: iconUrl,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    })
                }).addTo(map).bindPopup(popupText);

                // Hide the hidden div
                markerDiv.style.display = 'none';
            });
        });
    </script> --}}


    <!-- Leaflet CSS & Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

<!-- Leaflet JS & Routing Machine JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

{{-- <div id="map" style="width:100%; height:800px;"></div> --}}

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Map center: latest event first, else default
    const mapCenter = [
        {{ $latestEvent->latitude ?? 28.6139 }},
        {{ $latestEvent->longitude ?? 77.209 }}
    ];

    // Initialize map
    const map = L.map('map').setView(mapCenter, 13);

    // OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // User initial location
    let userLat = {{ $userLat ?? 28.6139 }};
    let userLng = {{ $userLng ?? 77.209 }};
    let lastLat = null;
    let lastLng = null;

    // User marker
    const userMarker = L.marker([userLat, userLng], {
        title: 'You are here',
        icon: L.icon({
            iconUrl: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            iconSize: [32, 32],
            iconAnchor: [16, 32]
        })
    }).addTo(map).bindPopup("<b>You are here</b>");

    // Add event markers from hidden divs
    const eventMarkers = [];
    document.querySelectorAll('.map-marker').forEach(function(markerDiv) {
        const lat = parseFloat(markerDiv.getAttribute('data-lat'));
        const lng = parseFloat(markerDiv.getAttribute('data-lng'));
        const popupText = markerDiv.innerHTML;
        const type = markerDiv.getAttribute('data-type');

        let iconUrl = (type === 'latest') ?
            'https://maps.google.com/mapfiles/ms/icons/red-dot.png' :
            'https://maps.google.com/mapfiles/ms/icons/green-dot.png';

        const marker = L.marker([lat, lng], {
            icon: L.icon({
                iconUrl: iconUrl,
                iconSize: [32, 32],
                iconAnchor: [16, 32]
            })
        }).addTo(map).bindPopup(popupText);

        eventMarkers.push(marker);
        markerDiv.style.display = 'none';
    });

    // Optional: pick first event as routing destination
    const destMarker = eventMarkers[0];
    if (destMarker) {
        const destLatLng = destMarker.getLatLng();

        // Routing control
        const routingControl = L.Routing.control({
            waypoints: [
                L.latLng(userLat, userLng),
                destLatLng
            ],
            routeWhileDragging: false,
            addWaypoints: false,
            show: true,
            lineOptions: { styles: [{ color: 'blue', weight: 5, opacity: 0.7 }] }
        }).addTo(map);

        // Track user position and update route in real time
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;

                // Update every meter
                if (!lastLat || getDistance(lastLat, lastLng, lat, lng) >= 1) {
                    lastLat = lat;
                    lastLng = lng;

                    // Move user marker
                    userMarker.setLatLng([lat, lng]);

                    // Update route dynamically
                    routingControl.setWaypoints([
                        L.latLng(lat, lng),
                        destLatLng
                    ]);

                    // Pan map to follow user
                    map.panTo([lat, lng]);
                }
            }, function(err){
                console.log("Geolocation error:", err);
            }, { enableHighAccuracy: true, maximumAge: 0, timeout: 5000 });
        }
    }

    // Haversine formula to calculate distance in meters
    function getDistance(lat1, lng1, lat2, lng2){
        const R = 6371000;
        const dLat = (lat2-lat1)*Math.PI/180;
        const dLng = (lng2-lng1)*Math.PI/180;
        const a = Math.sin(dLat/2)**2 +
                  Math.cos(lat1*Math.PI/180) *
                  Math.cos(lat2*Math.PI/180) *
                  Math.sin(dLng/2)**2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }
});
</script>




@endsection
