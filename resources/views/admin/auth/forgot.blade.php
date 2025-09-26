<!DOCTYPE html>
<html>
<head>
    <title>Admin Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.forgot.submit') }}">
        @csrf
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
