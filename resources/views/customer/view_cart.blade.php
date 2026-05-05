<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    {{-- Bootstrap 5 CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/cartproduct.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    {{-- Navbar Section --}}
    @include('customer.layouts.navbar')
    {{-- Main Wrapper --}}
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('customer.layouts.sidebar')
        {{-- Main Content Section --}}
        <main class="main-content">
            <div class="view-card">
                <h2 class="view-title">
                    <i class="fa fa-eye"></i> View Product
                </h2>
                {{-- Image --}}        
                <div class="view-image">
                    <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
                {{-- Name --}}
                <h3 class="product-name">{{ $product->name }}</h3>
                {{-- Description --}}
                <p class="product-description">{{ $product->description }}</p>
                {{-- Price --}}
                <p class="product-info">
                    <strong>Price:</strong> {{ $product->price }}
                </p>
                {{-- Back to product list --}}
                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="fa fa-circle-arrow-left"></i> Back
                </a>
            </div>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('customer.layouts.footer')
</body>
</html>
