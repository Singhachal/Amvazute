@extends('front.layouts.main')
@section('content')
    <section class="mb-0 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="signup-container">
                        <div class="form-section">
                            <h2 class="heading text-center">Welcome Back to <span>AM VAZUT</span></h2>
                            <p class="text-14 text-center">Log in to post updates, view alerts nearby, and stay connected to
                                your community in real time.</p>

                            <div class="social-buttons">
                               <a href="{{ route('google.login') }}" class="google-btn w-100 d-block text-center text-dark"><i class="fa-solid fa-magnifying-glass f6"></i>&nbsp;Sign up with
                                    Google</a>
                                <button class="apple-btn"><i class="fa-brands fa-apple"></i>&nbsp;Sign up with
                                    Apple</button>
                            </div>

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Error Messages --}}
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="divider">Or with email</div>
                            <div class="col-lg-12 col-md-12 ">
                                <form id="contactFormLogin" action="{{ route('login.post') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="Email Address" class="text-14 fw-semibold">Email </label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter your Email " required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password1" class="text-14 fw-semibold">Password</label>
                                            <div class="input-group">
                                                <input type="password" id="password1" name="password" class="form-control"
                                                    placeholder="Enter your password" required>
                                                <button class="input-group-text bg-none border-1 text-dark" type="button" id="togglePassword1">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkbox-row">
                                        <label for="terms">
                                            <a href="{{ route('forget.password.form') }}">Forget Password?</a>
                                        </label>
                                    </div>


                                    <button type="submit" class="signup-btn w-100">Login</button>
                                </form>
                            </div>

                            <p class="login-link text-center">Don’t have an account? <a href="{{ route('register') }}"> New here? Create an
                                    account</a></p>
                        </div>

                        <div class="image-section">
                            <img src="front/asset/img/home/login.jpg" alt="Crosswalk Image" height="320px"
                                width="100%" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    @endpush
@endsection
