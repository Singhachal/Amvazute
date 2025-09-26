<!DOCTYPE html>
<html>
<head>
    <title>Admin Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.reset.submit') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>New Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
