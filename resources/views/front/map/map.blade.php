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
                </div>



            </div>
        </div>
    </section>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_KEY') }}&libraries=places"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {

                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    $.ajax({
                        url: "{{ route('map.get.distance') }}",
                        type: "POST",
                        data: {
                            lat: lat,
                            lng: lng,
                            eventLat: "{{ $eventMap->latitude }}",
                            eventLng: "{{ $eventMap->longitude }}",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            $("#distanceTime").text(res.distance + " | " + res.duration);
                        },
                        error: function() {
                            $("#distanceTime").text("N/A");
                        }
                    });

                }, function() {
                    $("#distanceTime").text("Location blocked");
                });
            } else {
                $("#distanceTime").text("No GPS available");
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            if (!navigator.geolocation) {
                $(".relatedDistanceTime").text("GPS not available");
                $("#distanceTime").text("GPS not available");
                return;
            }

            navigator.geolocation.getCurrentPosition(function(position) {

                let userLat = position.coords.latitude;
                let userLng = position.coords.longitude;

                // ========== Main event AJAX ==========
                $.post("{{ route('map.get.distance') }}", {
                    _token: "{{ csrf_token() }}",
                    lat: userLat,
                    lng: userLng,
                    eventLat: "{{ $eventMap->latitude }}",
                    eventLng: "{{ $eventMap->longitude }}"
                }, function(res) {
                    $("#distanceTime").text(res.distance + " | " + res.duration);
                });

                // ========== Related posts AJAX ==========
                $(".relatedDistanceTime").each(function() {

                    let row = $(this);
                    let eventLat = row.data("lat");
                    let eventLng = row.data("lng");

                    $.post("{{ route('map.get.distance') }}", {
                        _token: "{{ csrf_token() }}",
                        lat: userLat,
                        lng: userLng,
                        eventLat: eventLat,
                        eventLng: eventLng
                    }, function(res) {
                        row.text(res.distance + " | " + res.duration);
                    });
                });

            }, function() {
                $("#distanceTime").text("Location blocked");
                $(".relatedDistanceTime").text("Location blocked");
            });

        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {

            let eventLat = parseFloat("{{ $eventMap->latitude }}");
            let eventLng = parseFloat("{{ $eventMap->longitude }}");
            let eventLocation = {
                lat: eventLat,
                lng: eventLng
            };

            // Initialize Map
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: eventLocation,
            });

            // Marker for event
            new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: "Event Location"
            });

            // Google Directions Services
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: false
            });

            // Get User Location & Draw Route
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition((pos) => {
                    let userLat = pos.coords.latitude;
                    let userLng = pos.coords.longitude;

                    let userLocation = {
                        lat: userLat,
                        lng: userLng
                    };

                    // Add user marker (blue)
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        title: "Your Location"
                    });

                    // Request directions
                    directionsService.route({
                        origin: userLocation,
                        destination: eventLocation,
                        travelMode: google.maps.TravelMode.DRIVING
                    }, function(result, status) {
                        if (status === "OK") {
                            directionsRenderer.setDirections(result);
                        } else {
                            console.log("Directions error:", status);
                        }
                    });

                }, function() {
                    console.log("User location blocked");
                });

            } else {
                console.log("Geolocation not available");
            }

        });
    </script> --}}

    <script>
document.addEventListener("DOMContentLoaded", function () {

    let eventLat = parseFloat("{{ $eventMap->latitude }}");
    let eventLng = parseFloat("{{ $eventMap->longitude }}");

    let eventLocation = { lat: eventLat, lng: eventLng };

    // Initialize Map
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: eventLocation
    });

    // Event marker
    new google.maps.Marker({
        position: eventLocation,
        map: map,
        title: "Event Location"
    });

    // Directions
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: false
    });

    // USER MARKER (dynamic)
    let userMarker = null;

    // Watch user location in real time
    if (navigator.geolocation) {

        navigator.geolocation.watchPosition(
            function (position) {

                let userLat = position.coords.latitude;
                let userLng = position.coords.longitude;
                let userLocation = { lat: userLat, lng: userLng };

                // Move or create user marker
                if (userMarker === null) {
                    userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                        title: "Your Live Location"
                    });
                } else {
                    userMarker.setPosition(userLocation);
                }

                // Redraw route in real time
                directionsService.route(
                    {
                        origin: userLocation,
                        destination: eventLocation,
                        travelMode: google.maps.TravelMode.DRIVING
                    },
                    function (result, status) {
                        if (status === "OK") {
                            directionsRenderer.setDirections(result);
                        }
                    }
                );

                // Update distance/time dynamically
                updateDistanceUI(userLat, userLng);

            },
            function () {
                console.log("User blocked GPS");
            },
            { enableHighAccuracy: true } // IMPORTANT for real-time accuracy
        );

    }

    // Update UI distance & time
    function updateDistanceUI(lat, lng) {
        $.post("{{ route('map.get.distance') }}", {
            _token: "{{ csrf_token() }}",
            lat: lat,
            lng: lng,
            eventLat: "{{ $eventMap->latitude }}",
            eventLng: "{{ $eventMap->longitude }}"
        }, function (res) {
            $("#distanceTime").text(res.distance + " | " + res.duration);
        });
    }

});
</script>

@endsection
