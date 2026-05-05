<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
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
        <h1>Reset Password</h1>
        <form action="{{ route('reset_password_update') }}" method="post">
            @csrf
            {{-- Token --}}
            <input type="hidden" name="token" value="{{ $token }}">
            {{-- Password field --}}
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="New Password">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password',this)"></i>
                <div class="error">@error('password') {{ $message }} @enderror</div>
            </div>
            {{-- Password Confirm field --}}
            <div class="form-group">
                <label for="password">Password Confirm:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password_confirmation',this)"></i>
                <div class="error">@error('password') {{ $message }} @enderror</div>
            </div>
            {{-- Submit --}}
            <div class="form-group">
                <button type="submit">Update Password</button>
            </div>
        </form>
    </div>
    {{-- Eye icon JS --}}
    <script>
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } 
            else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
