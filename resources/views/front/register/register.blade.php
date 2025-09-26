@extends('front.layouts.main')
@section('content')
    <section class="mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="signup-container">
                        <div class="form-section">
                            <h2 class="heading text-center">Create Your <span>AM VAZUT</span> Account</h2>
                            <p class="text-14 text-center">Join a growing community of real-time reporters, local observers,
                                and everyday
                                heroes.
                                Signing up is free and only takes a minute.</p>

                            {{-- <div class="social-buttons">
                                <a href="{{ route('google.login') }}" class="google-btn"><i class="fa-solid fa-magnifying-glass f6"></i>&nbsp;Sign up with
                                    Google</a>
                                <button class="apple-btn"><i class="fa-brands fa-apple"></i>&nbsp;Sign up with
                                    Apple</button>
                            </div> --}}

                            <div class="social-buttons">
                                <a href="{{ route('google.login') }}" class="google-btn w-100 d-block text-center">
                                    <i class="fa-brands fa-google"></i>&nbsp;Sign up with Google
                                </a>
                            </div>


                            <div class="divider">Or with email</div>
                            <form id="contactForm" method="POST" action="{{ route('register.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="text-14 fw-semibold">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter your full name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="Email Address" class="text-14 fw-semibold">Email </label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Enter your Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password1" class="text-14 fw-semibold">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password1" name="password" class="form-control"
                                                placeholder="Enter your password" required>
                                            <button class="input-group-text bg-secondary border-1 text-dark" type="button"
                                                id="togglePassword1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password2" class="text-14 fw-semibold">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password2" name="confirm_password"
                                                class="form-control" placeholder="Confirm your password" required>
                                            <button class="input-group-text bg-secondary border-1 text-dark" type="button"
                                                id="togglePassword2">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="checkbox-row">
                                        <input type="checkbox" id="terms" name="terms" required>
                                        <label for="terms">I agree to the <a href="#">Terms & Conditions</a> and <a
                                                href="#">Privacy Policy</a>.</label>
                                    </div>
                                    <button type="submit" class="signup-btn">Sign Up</button>
                            </form>
                        </div>
                        <p class="login-link text-center">Already have an account? <a href="#">Login</a></p>
                    </div>

                    <div class="image-section">
                        <img src="/front/asset/img/home/register.jpg" alt="Crosswalk Image" height="400px" width="100%" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <style>
        .bg-secondary {
            background: transparent !important;
        }
    </style>
    @push('scripts')
        <script>
            // Apply toggle functionality to all password fields
            document.querySelectorAll('[id^="togglePassword"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = btn.previousElementSibling; // The password field before the button
                    const icon = btn.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                });
            });
        </script>

        <script>
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();

                $(".signup-btn").prop("disabled", true).text("Please wait...");

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $(".signup-btn").prop("disabled", false).text("Sign Up");

                        if (response.status === "success") {
                            window.location.href = response.redirect; // Redirect after register
                        }
                    },
                    error: function(xhr) {
                        $(".signup-btn").prop("disabled", false).text("Sign Up");
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "";
                        for (let field in errors) {
                            errorMsg += errors[field][0] + "\n";
                        }
                        alert(errorMsg);
                    }
                });
            });
        </script>
    @endpush
@endsection
