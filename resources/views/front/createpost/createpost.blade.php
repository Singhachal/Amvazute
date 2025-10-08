@extends('front.layouts.main')
@section('content')
    <main id="main-div">

        <section>
            <div class="container my-5">
                <div class="row g-0">
                    <div class="col-lg-12 text-center">
                        <h2 class="heading">{!! __('messages.create_post_title') !!}</h2>
                        <p style="font-size: 15px;">{{ __('messages.create_post_desc') }}.</p>
                    </div>
                </div>
                <div class="post-card mt-sm-4 mt-2">
                    {{-- <form>
            <div class="row g-3 mb-3">
              <div class="col-md-3">
                <label class="form-label">Take Photo Now</label>
                <div class="input-group">
                  <!-- Hidden file input -->
                  <input type="file" id="fileInput" class="d-none" accept="image/*" capture="camera">

                  <!-- Readonly text box to show file name -->
                  <input type="text" id="fileName" class="form-control" placeholder="Launches device camera for live capture" readonly style="border-right: 0px !important;"/>

                  <!-- Camera button -->
                  <button class="input-group-text bg-secondary border-0 text-white" type="button" id="cameraBtn">
                    <i class="bi bi-camera"></i>
                  </button>
                </div>
              </div>

              <div class="col-md-3">
                <label class="form-label">Select Post Type</label>
                <select class="form-select form-control" name="postType">
                  <option selected disabled>select your post type</option>
                  <option>Image</option>
                  <option>Video</option>
                  <option>Text</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Location</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="location" placeholder="Your current location" style="border-right: 0px !important;"/>
                  <span class="input-group-text bg-secondary border-0 text-white">
                    <i class="bi bi-geo-alt-fill"></i>
                  </span>
                </div>
              </div>

              <div class="col-md-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Write post title" />
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Write a Caption</label>
              <textarea class="form-control" name="caption" rows="5" placeholder="Describe what's happening.."></textarea>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="termsCheck" name="terms" />
              <label class="form-check-label  text-14" for="termsCheck">
                By posting, you agree to our <a href="#" class=" text-light">[Terms of Use]</a> and
                <a href="#" class=" text-light">[Community Guidelines]</a>. Ensure your post is accurate and respectful.
              </label>
            </div>

            <button class="btn-primary-hero" type="submit">Post Now</button>
          </form> --}}

                    <form action="{{ route('eventFront.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Take Photo Now</label>
                                <div class="input-group">
                                    <input type="file" name="file" id="fileInput" class="d-none" accept="image/*"
                                        capture="camera" required>
                                    <input type="text" id="fileName" class="form-control" placeholder="Launch camera"
                                        readonly style="border-right: 0px !important;" required/>
                                    <button class="input-group-text bg-secondary border-0 text-white" type="button"
                                        id="cameraBtn">
                                        <i class="bi bi-camera"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Select Post Type</label>
                                <select class="form-select form-control" name="postType" required>
                                    <option selected disabled>select your post type</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="text">Text</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Choose Location</label>
                                <div class="input-group">
                                    <input type="text" id="locationInput" class="form-control"
                                        placeholder="Click pin to select" readonly style="border-right: 0px !important;">
                                    <span class="input-group-text bg-secondary border-0 text-white" id="pickLocationBtn">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </span>
                                </div>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Write post title"
                                    required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Write a Caption</label>
                            <textarea class="form-control" name="caption" rows="5" placeholder="Describe what's happening.."></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsCheck" name="terms" required />
                            <label class="form-check-label  text-14" for="termsCheck">
                                By posting, you agree to our <a href="/term">[Terms and condition]</a> and
                                <a href="/community">[Community Guidelines]</a>.
                            </label>
                        </div>

                        <button class="btn-primary-hero" type="submit">Post Now</button>
                    </form>


                </div>
            </div>
        </section>
    </main>
    <style>
        .form-select {
            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        }

        a {
            text-decoration: none !important;
        }

        .bg-secondary {
            background-color: rgba(26, 26, 26, 1) !important;
            border: 1px solid rgba(142, 142, 154, 1) !important;
        }

        .post-card {
            background-color: rgba(26, 26, 26, 1);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .form-control,
        .form-select {
            background-color: rgba(26, 26, 26, 1);
            color: white;
            border: 1px solid rgba(142, 142, 154, 1);
            padding: 10px;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-check-label {
            color: #ccc;
        }

        .btn-post {
            background-color: #dc3545;
            border: none;
        }

        .btn-post:hover {
            background-color: #bb2d3b;
        }

        .camera-button {
            display: flex;
            align-items: center;
            /* gap: 10px; */
        }

        .camera-button input {
            flex: 1;
        }
    </style>
    @push('scripts')
        <script>
            const fileInput = document.getElementById('fileInput');
            const fileName = document.getElementById('fileName');
            const cameraBtn = document.getElementById('cameraBtn');

            // When camera button is clicked, open file selector/camera
            cameraBtn.addEventListener('click', () => {
                fileInput.click();
            });

            // When a file is selected, show its name
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileName.value = fileInput.files[0].name;
                }
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let form = document.getElementById("postForm");

                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    let formData = new FormData(form);

                    fetch("{{ route('eventFront.store') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content")
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === "success") {
                                alert(data.message);
                                form.reset();
                                document.getElementById('locationInput').value = '';
                            } else {
                                alert("Something went wrong!");
                            }
                        })
                        .catch(err => console.error(err));
                });

                // Camera button
                document.getElementById('cameraBtn').addEventListener('click', function() {
                    document.getElementById('fileInput').click();
                });
                document.getElementById('fileInput').addEventListener('change', function() {
                    document.getElementById('fileName').value = this.files[0]?.name || '';
                });

            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const pickLocationBtn = document.getElementById('pickLocationBtn');
                const locationInput = document.getElementById('locationInput');
                const latInput = document.getElementById('latitude');
                const lngInput = document.getElementById('longitude');

                pickLocationBtn.addEventListener('click', function() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            // Store with 5 decimal places
                            latInput.value = lat.toFixed(5);
                            lngInput.value = lng.toFixed(5);

                            // Display nicely
                            locationInput.value = `Lat: ${lat.toFixed(5)}, Lng: ${lng.toFixed(5)}`;
                        }, function(error) {
                            alert("Location access denied or unavailable.");
                            console.error(error);
                        });
                    } else {
                        alert("Geolocation is not supported in this browser.");
                    }
                });
            });
        </script>

        <script>
            document.getElementById('postForm').addEventListener('submit', function(e) {
                const termsCheck = document.getElementById('termsCheck');
                if (!termsCheck.checked) {
                    e.preventDefault(); // prevent form submission
                    alert('Please accept the Terms and Conditions before posting.');
                    return false;
                }
            });
        </script>
    @endpush
@endsection
