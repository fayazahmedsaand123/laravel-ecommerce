<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    {{-- Bootstrap 5 CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/auth.css') }}">
</head>
<body>
    {{-- Container --}}
    <div class="main-container">
        <h1>Login</h1>
        <form action="{{ route('login_form') }}" method="post">
            @csrf
            {{-- Flesh message --}}
            @if(session('success'))
                <div id="success-alert" class="alert alert-success text-center">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="text-danger text-center">{{ session('fail') }}</div>
            @endif
            {{-- Email field --}} 
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
                <div class="error">@error('email') {{ $message }} @enderror</div>
            </div>
            {{-- Password field --}}  
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password',this)"></i>
                <div class="error">@error('password') {{ $message }} @enderror</div>
            </div>
            {{-- Submit --}}
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            {{-- Forget Password --}}
            <div class="form-group">
                <a href="{{ route('forget_password') }}">Forget Password?</a>
            </div>
            {{-- Register --}}
            <div class="form-group">
                <a href="{{ route('register') }}">Create New Account</a>
            </div>
        </form>
    </div>
    {{-- Eye icon JS --}}
    @include('auth.layouts.scripts')
</body>
</html>
