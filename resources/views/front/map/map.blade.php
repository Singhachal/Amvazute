@extends('front.layouts.main')
@section('content')
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
                            {{-- <small class="text-muted">300m away | 2 hours</small> --}}
                            <small class="text-muted" id="distanceTime">Loading...</small>
                            <h6 class="text-white mt-1">{{ $eventMap->title }}</h6>

                            <p class="small">{{ $eventMap->description }}</p>
                        </div>
                    </div>

                    @foreach ($relatedPosts as $related)
                        <div class="post-card d-flex mb-3">


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
                                {{-- <small class="text-muted">300m away | 2 hours</small> --}}
                                <small class="text-muted relatedDistanceTime" data-lat="{{ $related->latitude }}"
                                    data-lng="{{ $related->longitude }}">
                                    Calculating...
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
                {{-- <div class="col-lg-8 col-md-12 p-0">
                    <div id="map" style="width:100%; height:100vh;"></div>
                </div>

                <button id="getDirectionBtn" class="btn btn-primary mt-2">
                    Get Directions
                </button> --}}
                <div class="col-lg-8 col-md-12 p-0">
                    <div id="map" style="width:100%; height:100vh;"></div>
                    <button onclick="startNavigation()" class="btn btn-success"
                        style="position:absolute; top:20px; right:20px; z-index:999;">
                        Start Navigation
                    </button>

                </div>



            </div>
        </div>
    </section>
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&libraries=geometry&callback=initMap"
        async defer></script> --}}
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&libraries=geometry" async defer></script> --}}
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&libraries=geometry&callback=initMap" async defer></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {

            const eventLat = parseFloat("{{ $eventMap->latitude }}");
            const eventLng = parseFloat("{{ $eventMap->longitude }}");
            const eventLocation = {
                lat: eventLat,
                lng: eventLng
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: eventLocation,
                zoom: 15
            });

            // Event marker
            const eventMarker = new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: "Event Location"
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true
            });

            // User marker
            let userMarker = null;

            // Store previous step index for voice guidance
            let prevStepIndex = -1;

            // Start watching user location
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    function(pos) {
                        const userLat = pos.coords.latitude;
                        const userLng = pos.coords.longitude;
                        const userLocation = {
                            lat: userLat,
                            lng: userLng
                        };

                        // Add or update user marker
                        if (!userMarker) {
                            userMarker = new google.maps.Marker({
                                position: userLocation,
                                map: map,
                                icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                                title: "Your Location"
                            });
                        } else {
                            userMarker.setPosition(userLocation);
                        }

                        map.panTo(userLocation);

                        // Get route from user -> event
                        directionsService.route({
                            origin: userLocation,
                            destination: eventLocation,
                            travelMode: google.maps.TravelMode.DRIVING,
                            drivingOptions: {
                                departureTime: new Date()
                            }
                        }, function(result, status) {
                            if (status === "OK") {
                                directionsRenderer.setDirections(result);

                                // Optional: step-by-step guidance
                                const steps = result.routes[0].legs[0].steps;
                                steps.forEach((step, index) => {
                                    // check if user is close to this step
                                    const stepLat = step.end_location.lat();
                                    const stepLng = step.end_location.lng();
                                    const distance = google.maps.geometry.spherical
                                        .computeDistanceBetween(
                                            new google.maps.LatLng(userLat, userLng),
                                            new google.maps.LatLng(stepLat, stepLng)
                                        );

                                    if (distance < 30 && prevStepIndex <
                                        index) { // within 30 meters
                                        prevStepIndex = index;
                                        // Voice guidance
                                        if ('speechSynthesis' in window) {
                                            const msg = new SpeechSynthesisUtterance(step
                                                .instructions.replace(/<[^>]+>/g, ''));
                                            window.speechSynthesis.speak(msg);
                                        }
                                    }
                                });

                                // Update distance/time UI
                                updateDistanceUI(userLat, userLng);

                            } else {
                                console.warn("Directions error:", status);
                            }
                        });

                    },
                    function(err) {
                        console.error("GPS blocked", err);
                        $("#distanceTime").text("GPS blocked");
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 0,
                        timeout: 5000
                    }
                );
            }

            function updateDistanceUI(lat, lng) {
                $.post("{{ route('map.get.distance') }}", {
                    _token: "{{ csrf_token() }}",
                    lat: lat,
                    lng: lng,
                    eventLat: eventLat,
                    eventLng: eventLng
                }, function(res) {
                    $("#distanceTime").text(res.distance + " | " + res.duration);
                });
            }

        });
    </script> --}}

    <script>
        function initMap() {
    const eventLat = parseFloat("{{ $eventMap->latitude }}");
    const eventLng = parseFloat("{{ $eventMap->longitude }}");
    const eventLocation = { lat: eventLat, lng: eventLng };

    const map = new google.maps.Map(document.getElementById("map"), {
        center: eventLocation,
        zoom: 15
    });

    new google.maps.Marker({ position: eventLocation, map: map, title: "Event" });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({ map: map });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos){
            const userLocation = { lat: pos.coords.latitude, lng: pos.coords.longitude };
            new google.maps.Marker({ position: userLocation, map: map, icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png", title:"You" });

            directionsService.route({
                origin: userLocation,
                destination: eventLocation,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(result, status){
                if(status==="OK") directionsRenderer.setDirections(result);
                else alert("Directions failed: " + status);
            });
        }, function(err){ alert("GPS error: "+err.message); });
    }
}

    </script>
    <script>
        function startNavigation() {
    const eventLat = "{{ $eventMap->latitude }}";
    const eventLng = "{{ $eventMap->longitude }}";

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            let originLat = position.coords.latitude;
            let originLng = position.coords.longitude;

            // Google Maps turn-by-turn navigation URL
            let navigationUrl =
                `https://www.google.com/maps/dir/?api=1&origin=${originLat},${originLng}&destination=${eventLat},${eventLng}&travelmode=driving`;

            // Open Google Maps App / Website
            window.open(navigationUrl, "_blank");
        });
    } else {
        alert("GPS not supported");
    }
}

    </script>
@endsection
