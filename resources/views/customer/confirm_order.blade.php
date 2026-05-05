<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Order</title>
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/admin.css') }}">
</head>
<body>
    {{-- Container --}}
    <div class="form-container">
        {{-- Flesh message --}}
        @if(session('fail'))
            <div class="alert alert-danger text-center">{{ session('fail') }}</div>
        @endif
        {{-- Heading --}}
        <h3>Confirm Order</h3>
        <form action="{{ route('place_order') }}" method="POST">
            @csrf
            {{-- Name field --}}
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
                <div class="error">
                    @error('name')
                        <i class="fa fa-exclamation-circle"></i> {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Email field --}}
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <div class="error">
                    @error('email')
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Phone number field --}}
            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                <div class="error">
                    @error('phone')
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Address field --}}
            <div class="form-group">
                <textarea name="address" placeholder="Address">{{ old('address') }}</textarea>
                <div class="error">
                    @error('address')
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- Select Dropdown field --}}
            <div class="form-group">
                <select name="payment_method">
                    <option value="COD">Cash on Delivery</option>
                </select>
            </div>
            {{-- Submit --}}
            <div class="form-group">
                <button type="submit">Place Order</button>
            </div>
        </form>
        {{-- Back to Cart --}}
        <div class="text-center mb-3">
            <a href="{{ route('view_cart') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</body>
</html>