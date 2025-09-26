@extends('front.layouts.main')
@section('content')
<section class="difference-section py-0">
<header class="py-5 bg-light ">
    <div class="container text-center">
        <h2 class="mb-4">Forget Password</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('forget.password.submit') }}" method="POST" class="d-inline-block w-100 w-md-50">
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                <button type="submit" class="btn btn-primary">Send Link</button>
            </div>
        </form>
    </div>
</header>
</section>

@endsection
