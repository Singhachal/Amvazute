@extends('front.layouts.main')
@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success mt-2">Reset Password</button>
</form>

</div>
@endsection
