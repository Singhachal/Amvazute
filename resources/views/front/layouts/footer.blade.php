<footer class="bg-white text-dark pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <!-- Company Info -->
            <div class="col-lg-3 col-md-6 col-12">
                <a class=" fs-3 navbar-brand text-dark" href="/">
                    AM <span class="text-danger">VAZUT</span>
                </a>
                <p class="mb-4 mt-3">AM VAZUT is a location-based community platform that empowers people to share
                    real-time updates, alerts, and everyday moments from their surroundings. Built to keep neigh
                    borhoods informed and connected, we combine user-generated posts with smart geolocation tools to
                    help you stay aware anytime, anywhere.</p>

            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 col-6">
                <h5 class="mb-4 ps-sm-5 ps-0">Quick Links</h5>
                <ul class="list-unstyled ps-sm-5 ps-0">
                    <li class="mb-2"><a href="/" class="footer-link">Home</a></li>
                    {{-- <li class="mb-2"><a href="#" class="footer-link">Map View</a></li> --}}
                    <li class="mb-2"><a href="{{ url('map-view') }}" class="footer-link">Map View</a></li>
                    <li class="mb-2"><a href="/create-post" class="footer-link">Create Post</a></li>
                    {{-- <li class="mb-2"><a href="#" class="footer-link">Events</a></li> --}}
                    <li class="mb-2"><a href="{{ url('event') }}" class="footer-link">Events</a></li>
                    <li class="mb-2"><a href="/about" class="footer-link">About Us</a></li>
                    <li class="mb-2"><a href="/contact" class="footer-link">Contact Us</a></li>
                    <li class="mb-2"><a href="{{ route('blog') }}" class="footer-link">Blog</a></li>
                </ul>
            </div>

            <!-- Services -->
            {{-- <div class="col-lg-2 col-md-6 col-6">
              <h5 class="mb-4">Contact</h5>
              <ul class="list-unstyled">
                  <li class="mb-2"><a href="#" class="footer-link">Instagram</a></li>
                  <li class="mb-2"><a href="#" class="footer-link">Facebook</a></li>
                  <li class="mb-2"><a href="#" class="footer-link">Twitter/X</a></li>
                  <li class="mb-2"><a href="#" class="footer-link">Youtube</a></li>
                  <li class="mb-2"><a href="/register" class="footer-link">Register</a></li>
                  <li class="mb-2"><a href="/login" class="footer-link">Login</a></li>
              </ul>
          </div> --}}

            {{-- <div id="social-footer" class="col-lg-2 col-md-6 col-6">
                <h5 class="mb-4">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="footer-link">Instagram</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Facebook</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Twitter/X</a></li>
                    <li class="mb-2"><a href="#" class="footer-link">Youtube</a></li>
                </ul>
            </div> --}}

            @php
                $contact = \App\Models\Contact::first();
            @endphp

            <div id="social-footer" class="col-lg-2 col-md-6 col-6">
                <h5 class="mb-4">Contact</h5>
                <ul class="list-unstyled">
                    @if ($contact && $contact->instagram)
                        <li class="mb-2"><a href="{{ $contact->instagram }}" target="_blank"
                                class="footer-link">Instagram</a></li>
                    @endif

                    @if ($contact && $contact->facebook)
                        <li class="mb-2"><a href="{{ $contact->facebook }}" target="_blank"
                                class="footer-link">Facebook</a></li>
                    @endif

                    @if ($contact && $contact->twitter)
                        <li class="mb-2"><a href="{{ $contact->twitter }}" target="_blank"
                                class="footer-link">Twitter/X</a></li>
                    @endif

                    @if ($contact && $contact->youtube)
                        <li class="mb-2"><a href="{{ $contact->youtube }}" target="_blank"
                                class="footer-link">YouTube</a></li>
                    @endif

                    @if ($contact && $contact->linkedin)
                        <li class="mb-2"><a href="{{ $contact->linkedin }}" target="_blank"
                                class="footer-link">LinkedIn</a></li>
                    @endif

                    @if ($contact && $contact->website)
                        <li class="mb-2"><a href="{{ $contact->website }}" target="_blank"
                                class="footer-link">Website</a></li>
                    @endif
                </ul>
            </div>



            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="mb-4">Legal</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="/term" class="footer-link">Terms & Condition</a></li>
                    <li class="mb-2"><a href="/privacy" class="footer-link">Privacy Policy</a></li>
                    <li class="mb-2"><a href="/community" class="footer-link">Community Guidlines</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="mb-4">Mobile Application</h5>
                <p>Take AM VAZUT on the go!</p>
                {{-- <button type="submit" class="btn-primary-hero signup-btn mt-3 " style="font-size:13px;">Download
                    App</button> --}}



            </div>
        </div>

        <!-- Copyright -->
        <div class="row mt-5">
            <div class="col-12">
                <hr class="mb-4">
                <div class="text-center">
                    <p class="mb-0">©2025 Developed By <a href="https://injoriatechnologies.com">Injoria
                            Technologies</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
    /* footer  */
    .footer-link {
        color: #000;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: var(--main-color);
    }

    .social-icon {
        width: 35px;
        height: 35px;
        line-height: 35px;
        border-radius: 50%;
        text-align: center;
        color: #fff;
        display: inline-block;
        margin: 0 3px;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        transform: translateY(-3px);
        color: #000;
    }

    #hireds h2 {
        font-size: 20px;
    }

    #hireds .card {
        border-radius: 15px !important;
        padding: 13px !important;
    }

    #hireds .card .text-muted-cal {
        color: gray;
    }

    #hireds .card:hover .text-muted-cal {
        color: #fff;
    }

    #hireds .card:hover .btn-primary-hero {
        background-color: #fff !important;
        color: #000;
    }

    #hireds .card img {
        border-radius: 15px !important;
        /* padding: 15px !important; */
    }

    #hireds .card:hover {
        background-color: var(--dark-blue);
        color: #fff !important;
    }

    #div-card-section>div {
        background: url('../img/home/Hired.png');
        background-position: center;
        background-size: 100% 100%;
        padding: 60px 80px;
        border-radius: 10px;
        color: #fff;
    }

    #div-card-section h2 {
        margin-bottom: 20px;
    }

    #div-card-section p {
        margin-bottom: 30px;

    }
</style>
