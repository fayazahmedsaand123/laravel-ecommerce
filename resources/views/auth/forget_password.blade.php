<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/auth.css') }}">
</head>
<body>
    {{-- Container --}}
    <div class="main-container">
        <h1>Forgot Password</h1>
        <form action="{{ route('forgot_password_send') }}" method="post">
            @csrf
            {{-- Flesh message --}}
            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="text-danger text-center">{{ session('fail') }}</div>
            @endif
            {{-- Email field --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email">
                <div class="error">@error('email') {{ $message }} @enderror</div>
            </div>
            {{-- Submit --}}
            <div class="form-group">
                <button type="submit">Send Reset Link</button>
            </div>
            {{-- Register --}}
            <div class="form-group">
                <a href="{{ route('login') }}">Back to login !!</a>
            </div>
        </form>
    </div>
</body>
</html>
