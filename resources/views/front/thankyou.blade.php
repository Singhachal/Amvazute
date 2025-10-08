@extends('front.layouts.main')
@section('content')

@section('content')
<div class="container text-center" style="margin-top: 120px">
    <h1 class="text-success fw-bold">🎉 Thank You!</h1>
    <p>Your event has been posted successfully.</p>
    <a href="{{ route('home') }}" class="btn btn-primary" style="margin-bottom: 50px">Back to Home</a>
</div>
@endsection
