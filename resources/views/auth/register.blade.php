<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Form</title>
    {{-- Bootstrap 5 CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/auth.css') }}">
</head>
<body>
    <div class="main-container">
        <h1>Sign Up</h1>
        <form action="{{ route('register_form') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Name field --}}
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                <div class="error">@error('name') {{ $message }} @enderror</div>
            </div>
            {{-- Email field --}}
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                <div class="error">@error('email') {{ $message }} @enderror</div>
            </div>
            {{-- Password field --}}
            <div class="form-group position-relative">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password',this)"></i>
                <div class="error">@error('password') {{ $message }} @enderror</div>
            </div>
            {{-- Password Confirm field --}}
            <div class="form-group position-relative">
                <label for="password">Password Confirm</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter password confirm">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password_confirmation',this)"></i>
                <div class="error">@error('password') {{ $message }} @enderror</div>
            </div>
            {{-- New Profile Image field --}}
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control">
                <div class="error">@error('profile_image') {{ $message }} @enderror</div>
            </div>
            {{-- Role --}}
            <input type="hidden" name="role" value="seller">
            {{-- Submit --}}
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            {{-- Login --}}
            <div class="form-group">
                <a href="{{ route('login') }}">Already Registered? Login</a>
            </div>
        </form>
    </div>
    {{-- Eye icon JS --}}
    @include('auth.layouts.scripts')
</body>
</html>
