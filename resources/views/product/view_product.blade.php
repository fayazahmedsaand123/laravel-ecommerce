<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Product</title>
    {{-- Bootstrap 5 CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/product.css') }}">
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Navbar Section --}}
    @include('product.layouts.navbar')
    {{-- Container --}}
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('product.layouts.sidebar')
        {{-- Main content section --}}
        <main class="main-content">
            <div class="view-card">
                <h2 class="view-title">
                    <i class="fa fa-eye"></i> View Product
                </h2>
                <div class="view-image">
                    <img src="{{ asset('product_image/'.$view_product->product_image) }}"
                         alt="Product Image">
                </div>
                {{-- Name --}}
                <h3 class="product-name">{{ $view_product->product_name }}</h3>
                {{-- Price --}}
                <p class="product-info">
                    <strong>Price:</strong> {{ $view_product->product_price }}
                </p>
                {{-- Description --}}
                <p class="product-info">
                    <strong>Description:</strong> {{ $view_product->product_description }}
                </p>
                {{-- Back --}}
                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="fa fa-circle-arrow-left"></i> Back
                </a>
            </div>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('product.layouts.footer')
    {{-- JS Section --}}
    @include('product.layouts.scripts')
</body>
</html>
