@extends('front.layouts.main')
@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

        /* Hide the routing control sidebar */
        .leaflet-routing-container {
            display: none;
        }
    </style>
    <section class="">
        <div class="container-fluid">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar mt-5 mt-sm-1 p-3">
                    {{-- <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-0 text-white">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="search" class="form-control bg-dark text-white border-0"
                                placeholder="Search posts, places, or alerts...">
                        </div>
                    </div> --}}
                    {{-- <div class="filter-bar mb-3 ">
                        <button class="filter-button">View posts within<i class="arrow-down"></i></button>
                        <button class="filter-button">Post Type <i class="arrow-down"></i></button>
                        <button class="filter-button">Sort By <i class="arrow-down"></i></button>
                    </div> --}}
                    {{-- <img src="/front/asset/img/home/Frame1.png" class="me-3" alt="" style="height:300px; width:100%;">
                    <div class="post-card d-flex">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Beautiful morning at herastrau Park. Fresh air and good vibes.</h6>
                            <p class="small">Enjoying the outdoors? This local capture reminds us to take a breath and appreciate the moment.</p>
                        </div>
                    </div> --}}

                    @if ($eventMap->media->isNotEmpty())
                        <img src="{{ asset('admin/uploads/event/' . $eventMap->media_path) }}" class="me-3"
                            alt="{{ $eventMap->title }}" style="height:300px; width:100%;">
                    @else
                        <img src="{{ asset('front/asset/img/home/Frame1.png') }}" class="me-3" alt="Default Image"
                            style="height:300px; width:100%;">
                    @endif

                    <div class="post-card d-flex">
                        <div>
                            {{-- Example static "away" and "time" — replace with real calculations --}}
                            {{-- <small class="text-muted">300m away | {{ $event->created_at->diffForHumans() }}</small> --}}
                            <small class="text-muted">
                                @if (!empty($distance_text))
                                    {{ $distance_text }} |
                                @endif
                                {{ $eventMap->created_at->diffForHumans() }}
                            </small>



                            <h6 class="text-white mt-1">{{ $eventMap->title }}</h6>

                            <p class="small">{{ $eventMap->description }}</p>
                        </div>
                    </div>


                    <!-- Post 1 -->
                    {{-- <div class="post-card d-flex">
                        <img src="/front/asset/img/home/Frame1.png" class="me-3" alt="">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Beautiful morning at herastrau Park. Fresh air and good vibes.</h6>
                            <p class="small">Enjoying the outdoors? This local capture reminds us to take a breath and
                                appreciate the moment.</p>
                        </div>
                    </div> --}}

                    {{-- <!-- Post 2 -->
                    <div class="post-card d-flex">
                        <img src="https://via.placeholder.com/80x60" class="me-3" alt="">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Traffic light not working near Piata Romana. Drive with caution!
                            </h6>
                            <p class="small">A quick heads-up about a traffic issue.</p>
                        </div>
                    </div>

                    <!-- Post 3 -->
                    <div class="post-card d-flex">
                        <img src="https://via.placeholder.com/80x60" class="me-3" alt="">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Tried a shawarma from this tiny cart...</h6>
                            <p class="small">Hidden food spots like this make the city feel alive.</p>
                        </div>
                    </div>

                    <!-- Post 4 -->
                    <div class="post-card d-flex">
                        <img src="https://via.placeholder.com/80x60" class="me-3" alt="">
                        <div>
                            <small class="text-muted">300m away | 15 min ago</small>
                            <h6 class="text-white mt-1">Blocked sidewalk on Str. Polona.</h6>
                            <p class="small">Be careful walking around here.</p>
                        </div>
                    </div> --}}

                    @foreach ($relatedPosts as $related)
                        <div class="post-card d-flex mb-3">
                            {{-- Image --}}
                            {{-- @if ($related->media->isNotEmpty())
                                <img src="{{ asset('admin/uploads/event/' . $related->media_path) }}" class="me-3"
                                    alt="{{ $related->title }}" style="width:80px; height:60px; object-fit:cover;">
                            @else
                                <img src="https://via.placeholder.com/80x60" class="me-3" alt="Default Image">
                            @endif --}}

                            @php
                                $mediaPath = $related->media->isNotEmpty()
                                    ? $related->media->first()->media_path
                                    : null;
                                $eventImagePath = $related->media_path ?? null;

                                if (!empty($mediaPath)) {
                                    $imageUrl = asset('admin/uploads/event/' . $mediaPath);
                                } elseif (!empty($eventImagePath)) {
                                    $imageUrl = asset('admin/uploads/event/' . $eventImagePath);
                                } else {
                                    $imageUrl = 'https://via.placeholder.com/80x60';
                                }
                            @endphp

                            <img src="{{ $imageUrl }}" class="me-3" alt="{{ $related->title }}"
                                style="width:80px; height:60px; object-fit:cover;">


                            <div>
                                {{-- Distance (can be replaced with dynamic distance calculation) --}}
                                {{-- <small class="text-muted">300m away | {{ $related->created_at->diffForHumans() }}</small> --}}

                                <small class="text-muted">
                                    @if (isset($related->distance_text))
                                        {{ $related->distance_text }} km away
                                    @else
                                        Distance unknown
                                    @endif
                                    | {{ $related->created_at->diffForHumans() }}
                                </small>

                                {{-- Title --}}
                                <h6 class="text-white mt-1">
                                    <a href="{{ url('eventdetail/' . $related->id) }}"
                                        class="text-white text-decoration-none">
                                        {{ $related->title }}
                                    </a>
                                </h6>


                                {{-- Short description --}}
                                <p class="small">
                                    {{ Str::limit($related->description, 80) }}
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

                <div class="col-lg-8 col-md-12 map-container">
                    <div id="map" style="width:100%; height:800px;" allowfullscreen></div>
                </div>

            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        (function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('lat') || !urlParams.has('lng')) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        let lat = position.coords.latitude;
                        let lng = position.coords.longitude;
                        // Redirect with user location
                        window.location.href = `${window.location.pathname}?lat=${lat}&lng=${lng}`;
                    }, function(error) {
                        console.log("Location access denied or unavailable.");
                    });
                } else {
                    console.log("Geolocation is not supported by this browser.");
                }
            }
        })();
    </script>



    <!-- Leaflet JS -->
    {{-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get event latitude & longitude from Laravel
            let eventLat = {{ $eventMap->latitude }};
            let eventLng = {{ $eventMap->longitude }};

            // Initialize the map centered on the event location
            let map = L.map('map').setView([eventLat, eventLng], 15);

            // Load map tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Add red marker for event location
            let marker = L.marker([eventLat, eventLng], {
                title: "{{ $eventMap->title }}"
            }).addTo(map);

            // Reverse geocode to get the address from lat/lng
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${eventLat}&lon=${eventLng}`)
                .then(response => response.json())
                .then(data => {
                    let address = data.display_name || "Address not found";
                    marker.bindPopup(`<strong>{{ $eventMap->title }}</strong><br>${address}`).openPopup();
                });
        });
    </script> --}}

    <!-- Leaflet CSS & JS -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Leaflet Routing Machine CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script> --}}


    {{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    let eventLat = {{ $eventMap->latitude }};
    let eventLng = {{ $eventMap->longitude }};
    let userLat = {{ $userLat }};
    let userLng = {{ $userLng }};

    // Initialize map centered on user location
    let map = L.map('map').setView([userLat, userLng], 14);

    // OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Event marker
    L.marker([eventLat, eventLng])
        .addTo(map)
        .bindPopup("<strong>{{ $eventMap->title }}</strong>")
        .openPopup();

    // Routing control
    let routingControl = L.Routing.control({
        waypoints: [
            L.latLng(userLat, userLng),
            L.latLng(eventLat, eventLng)
        ],
        routeWhileDragging: false,
        addWaypoints: false,
        show: false,
        lineOptions: { styles: [{ color: 'blue', weight: 5, opacity: 0.7 }] }
    }).addTo(map);

    // Live tracking: update route if user moves
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            // Update route dynamically
            routingControl.setWaypoints([
                L.latLng(lat, lng),
                L.latLng(eventLat, eventLng)
            ]);

            // Optional: center map on user
            map.setView([lat, lng], 14);
        }, function(err) {
            console.log("Geolocation error:", err);
        }, {
            enableHighAccuracy: true,
            maximumAge: 1000
        });
    } else {
        console.log("Geolocation not supported by this browser.");
    }
});
</script> --}}

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
    let eventLat = {{ $eventMap->latitude }};
    let eventLng = {{ $eventMap->longitude }};
    let userLat = {{ $userLat }};
    let userLng = {{ $userLng }};

    // Initialize map
    let map = L.map('map').setView([userLat, userLng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Event marker
    L.marker([eventLat, eventLng]).addTo(map)
        .bindPopup("<strong>{{ $eventMap->title }}</strong>").openPopup();

    // Global routing control
    let routingControl = L.Routing.control({
        waypoints: [
            L.latLng(userLat, userLng),
            L.latLng(eventLat, eventLng)
        ],
        routeWhileDragging: false,
        addWaypoints: false,
        show: true,
        lineOptions: { styles: [{ color: 'blue', weight: 5, opacity: 0.7 }] }
    }).addTo(map);

    // Store last coordinates to avoid unnecessary updates
    let lastLat = userLat;
    let lastLng = userLng;

    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(pos) {
            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;

            // Update only if moved more than 5 meters
            if (!lastLat || getDistance(lastLat, lastLng, lat, lng) > 5) {
                lastLat = lat;
                lastLng = lng;

                // Update route dynamically
                routingControl.setWaypoints([
                    L.latLng(lat, lng),
                    L.latLng(eventLat, eventLng)
                ]);

                // Optionally follow user
                map.panTo([lat, lng]);
            }

        }, function(err) {
            console.log("Geolocation error:", err);
        }, { enableHighAccuracy: true, maximumAge: 0 });
    }

    // Distance function in meters
    function getDistance(lat1, lng1, lat2, lng2) {
        const R = 6371000;
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLng = (lng2 - lng1) * Math.PI / 180;
        const a = Math.sin(dLat/2)**2 +
                  Math.cos(lat1*Math.PI/180) *
                  Math.cos(lat2*Math.PI/180) *
                  Math.sin(dLng/2)**2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c;
    }
});

</script> --}}

    {{-- <!-- Leaflet CSS & Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

<!-- Leaflet JS & Routing Machine JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

<div id="map" style="width:100%; height:800px;"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventLat = {{ $eventMap->latitude }};
    const eventLng = {{ $eventMap->longitude }};
    let lastLat = null;
    let lastLng = null;

    // Initialize the map centered on user location (fallback)
    let map = L.map('map').setView([{{ $userLat }}, {{ $userLng }}], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Event marker
    L.marker([eventLat, eventLng]).addTo(map)
        .bindPopup("<strong>{{ $eventMap->title }}</strong>")
        .openPopup();

    // Routing control
    let routingControl = L.Routing.control({
        waypoints: [
            L.latLng({{ $userLat }}, {{ $userLng }}),
            L.latLng(eventLat, eventLng)
        ],
        routeWhileDragging: false,
        addWaypoints: false,
        show: true,
        lineOptions: { styles: [{ color: 'blue', weight: 5, opacity: 0.7 }] }
    }).addTo(map);

    // User marker
    let userMarker = L.marker([{{ $userLat }}, {{ $userLng }}], {
        icon: L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
            iconSize: [30, 30]
        })
    }).addTo(map);

    // Track user position
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;

            // Update every 1 meter
            if (!lastLat || getDistance(lastLat, lastLng, lat, lng) >= 1) {
                lastLat = lat;
                lastLng = lng;

                // Move user marker
                userMarker.setLatLng([lat, lng]);

                // Update route dynamically
                routingControl.setWaypoints([
                    L.latLng(lat, lng),
                    L.latLng(eventLat, eventLng)
                ]);

                // Pan map to follow user
                map.panTo([lat, lng]);
            }
        }, function(err) {
            console.log("Geolocation error:", err);
        }, {
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 5000
        });
    } else {
        alert("Geolocation is not supported by your browser.");
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
</script> --}}



    <!-- Leaflet CSS & Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Leaflet JS & Routing Machine JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

    {{-- <div id="map" style="width:100%; height:800px;"></div> --}}

    <script>
        // Coordinates from Laravel
        const eventLat = {{ $eventMap->latitude }};
        const eventLng = {{ $eventMap->longitude }};
        let lastLat = null;
        let lastLng = null;

        // Initialize map
        let map = L.map('map').setView([{{ $userLat }}, {{ $userLng }}], 16);

        // OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Event marker
        L.marker([eventLat, eventLng])
            .addTo(map)
            .bindPopup("<strong>{{ $eventMap->title }}</strong>")
            .openPopup();

        // User marker
        let userMarker = L.marker([{{ $userLat }}, {{ $userLng }}], {
            icon: L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconSize: [30, 30]
            })
        }).addTo(map);

        // Routing control
        let routingControl = L.Routing.control({
            waypoints: [
                L.latLng({{ $userLat }}, {{ $userLng }}),
                L.latLng(eventLat, eventLng)
            ],
            routeWhileDragging: false,
            addWaypoints: false,
            show: true,
            lineOptions: {
                styles: [{
                    color: 'blue',
                    weight: 5,
                    opacity: 0.7
                }]
            }
        }).addTo(map);

        // Haversine formula to calculate distance in meters
        function getDistance(lat1, lng1, lat2, lng2) {
            const R = 6371000;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                Math.cos(lat1 * Math.PI / 180) *
                Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) ** 2;
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        // Watch user position
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function(pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;

                // Update every 1 meter
                if (!lastLat || getDistance(lastLat, lastLng, lat, lng) >= 1) {
                    lastLat = lat;
                    lastLng = lng;

                    // Move user marker
                    userMarker.setLatLng([lat, lng]);

                    // Update route dynamically
                    routingControl.setWaypoints([
                        L.latLng(lat, lng),
                        L.latLng(eventLat, eventLng)
                    ]);

                    // Smoothly pan map
                    map.panTo([lat, lng]);
                }
            }, function(err) {
                console.log("Geolocation error:", err);
            }, {
                enableHighAccuracy: true,
                maximumAge: 0,
                timeout: 5000
            });
        } else {
            alert("Geolocation is not supported by your browser.");
        }
    </script>
@endsection
