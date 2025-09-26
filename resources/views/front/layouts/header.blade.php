<nav class="navbar navbar-expand-lg custom-navbar position-fixed top-0 w-100">
    <div class="container px-4 py-2">
        <!-- Brand -->
        <a class="navbar-brand" href="/">
            AM <span class="text-danger">VAZUT</span>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Navigation links -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('map-view') }}">Map View</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/create-post">Create Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/event">Events</a>
                </li>
            </ul>

            <!-- Right side icons and button -->
            <div class="navbar-icons">
                {{-- <button class="icon-btn" title="Camera">
                    <i class="fas fa-camera"></i>
                </button> --}}
                <a href="{{ url('create-post') }}">
                    <button class="icon-btn" title="Camera">
                        <i class="fas fa-camera"></i>
                    </button>
                </a>

                <button class="icon-btn position-relative" title="Profile" id="profileBtn">
                    <i class="fas fa-user"></i>
                </button>

                <div class="dropdown" id="profileDropdown">
                    @auth
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endauth
                </div>


                <!-- Language Selector Button -->
                <button class="icon-btn position-relative" title="Language" id="languageBtn" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-globe"></i>
                </button>

                <!-- Language Dropdown -->
                {{-- <div class="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageBtn">
                        @foreach (available_languages() as $code => $lang)
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ url('set-locale/' . $code) }}">
                                    <img src="{{ asset('front/assets/img/flags/' . $lang['flag']) }}"
                                        alt="{{ $lang['name'] }}" class="me-2" width="20">
                                    {{ $lang['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}

                {{-- <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="languageBtn"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        🌐 Language
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageBtn">
                        @foreach (available_languages() as $code => $lang)
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('set-locale', $code) }}">
                                    <img src="{{ asset('front/assets/img/flags/' . $lang['flag']) }}"
                                        alt="{{ $lang['name'] }}" class="me-2" width="20">
                                    {{ $lang['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}

                @php
    // Map language codes to flag country codes
    $flagMap = [
        'en' => 'us',   // English -> US flag
        'fr' => 'fr',   // French
        'es' => 'es',   // Spanish
        'de' => 'de',   // German
        'it' => 'it',   // Italian
        'pt' => 'pt',   // Portuguese
        'ru' => 'ru',   // Russian
        'tr' => 'tr',   // Turkish
        'cn' => 'cn',   // Chinese
        'jp' => 'jp',   // Japanese
        'in' => 'in',   // Hindi/India
    ];
@endphp

<div class="dropdown">
    <button class="btn btn-light dropdown-toggle" type="button" id="languageBtn"
        data-bs-toggle="dropdown" aria-expanded="false">
        🌐 Language
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageBtn">
        @foreach (available_languages() as $code => $lang)
            @php
                $flagCode = $flagMap[$code] ?? strtolower($code);
            @endphp
            <li>
                <a class="dropdown-item d-flex align-items-center"
                   href="{{ route('set-locale', $code) }}">

                    <img src="https://flagcdn.com/20x15/{{ $flagCode }}.png"
                         alt="{{ $lang['name'] }}" class="me-2" width="20" height="15">
                    <span>{{ $lang['name'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>





                {{-- <button class="icon-btn has-notification" title="Notifications">
                    <i class="fas fa-bell"></i>
                </button> --}}

                <div class="nav-separator d-none d-lg-block"></div>

                <a href="/contact" class="btn contact-btn">Contact Us</a>
            </div>
        </div>
    </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

{{-- <script>
    // Tab active functionality
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Set initial active tab with notification
        navLinks[3].classList.add('has-notification'); // Events tab initially has notification

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                // Remove active class and notification from all nav links
                navLinks.forEach(navLink => {
                    navLink.classList.remove('active', 'has-notification');
                });

                // Add active class and notification to clicked link
                this.classList.add('active', 'has-notification');

                // Close mobile menu if open
                const navbarCollapse = document.getElementById('navbarNav');
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse && navbarCollapse.classList.contains('show')) {
                    bsCollapse.hide();
                }

                // Optional: You can add page content switching logic here
                console.log('Active tab:', this.textContent.trim());
            });
        });
    });
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        // Get saved active tab from localStorage
        const savedHref = localStorage.getItem('activeTab');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');

            // If savedHref matches this link, make it active
            if (savedHref && href === savedHref) {
                link.classList.add('active', 'has-notification');
            }

            // Add click listener
            link.addEventListener('click', function (e) {
                // Prevent default only for dummy links
                if (href === '#' || href === '') {
                    e.preventDefault();
                }

                // Remove active + notification from all
                navLinks.forEach(nav => nav.classList.remove('active', 'has-notification'));

                // Add to clicked
                this.classList.add('active', 'has-notification');

                // Save clicked tab in localStorage
                localStorage.setItem('activeTab', href);

                // Optional: close mobile navbar if open
                const navbarCollapse = document.getElementById('navbarNav');
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse && navbarCollapse.classList.contains('show')) {
                    bsCollapse.hide();
                }
            });
        });

        // If no tab is saved yet, default to Home
        if (!savedHref) {
            const homeLink = document.querySelector('.nav-link[href="/"]');
            if (homeLink) {
                homeLink.classList.add('active');
            }
        }
    });
</script> --}}
<style>
    .icon-btn {
        font-size: 24px;
        cursor: pointer;
        background: none;
        border: none;
        position: relative;
    }

    .dropdown {
        display: none;
        position: absolute;
        top: 52px;
        right: 230px;
        background: black;
        /* border: 1px solid #ccc; */
        width: 150px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        z-index: 100;
    }

    /* Dropdown show on hover of button */
    .icon-btn:hover+.dropdown,
    .dropdown:hover {
        display: block;
    }

    .dropdown a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: white;
    }

    .dropdown a:hover {
        background-color: #eee;
        color: black;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const currentPath = window.location.pathname;

        // List of header tab hrefs (for matching)
        const validTabHrefs = Array.from(navLinks).map(link => link.getAttribute('href'));

        // If current URL doesn't match any header tab → remove notification
        if (!validTabHrefs.includes(currentPath)) {
            navLinks.forEach(link => link.classList.remove('has-notification'));
            localStorage.removeItem('activeTab'); // Optional: clear saved tab
        }

        // Get saved active tab from localStorage
        const savedHref = localStorage.getItem('activeTab');

        navLinks.forEach(link => {
            const href = link.getAttribute('href');

            // If savedHref matches and URL is valid
            if (savedHref === href && validTabHrefs.includes(currentPath)) {
                link.classList.add('active', 'has-notification');
            }

            // Add click listener
            link.addEventListener('click', function(e) {
                if (href === '#' || href === '') {
                    e.preventDefault();
                }

                // Remove active + notification from all
                navLinks.forEach(nav => nav.classList.remove('active', 'has-notification'));

                // Add to clicked
                this.classList.add('active', 'has-notification');

                // Save clicked tab in localStorage
                localStorage.setItem('activeTab', href);

                // Close navbar if open (optional)
                const navbarCollapse = document.getElementById('navbarNav');
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse && navbarCollapse.classList.contains('show')) {
                    bsCollapse.hide();
                }
            });
        });

        // If no saved tab, default to Home
        if (!savedHref && validTabHrefs.includes(currentPath)) {
            const homeLink = document.querySelector('.nav-link[href="/"]');
            if (homeLink) {
                homeLink.classList.add('active');
            }
        }
    });
</script>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    profileBtn.addEventListener('click', () => {
        dropdown.classList.toggle('show');
    });

    // Optional: Click anywhere outside to close dropdown
    window.addEventListener('click', (e) => {
        if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
</script>
