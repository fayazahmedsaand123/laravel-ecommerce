<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Update Product</title>
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
        {{-- Back to product list --}}
        <div style="margin-left: 20px;">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
                <i class="fa fa-arrow-circle-left me-2" aria-hidden="true"></i>Back
            </a>
        </div>
        {{-- Main Content Section --}}
        <main class="main-content">
            <h1 class="add_product">Update Product</h1>
            {{-- Flesh message --}}
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="error">{{ session('fail') }}</div>
            @endif
            <form id="UpdateProductForm" action="{{ route('products_update', $update_product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Hidden redirect --}}
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                {{-- Name field --}}
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" value="{{ $update_product->product_name }}">
                    <div class="error error-product_name"></div>
                </div>
                {{-- Price field --}}
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" name="product_price" id="product_price" step="0.01" value="{{ $update_product->product_price }}">
                    <div class="error error-product_price"></div>
                </div>
                {{-- Description field --}}
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea name="product_description" id="product_description" rows="4">{{ $update_product->product_description }}</textarea>
                    <div class="error error-product_description">@error('product_description') {{ $message }} @enderror</div>
                </div>
                {{-- Old Image field --}}
                <div class="form-group">
                    <label>Current Image</label>
                    <input type="hidden" id="old_image" value="{{ $update_product->product_image }}">
                    <img id="imagePreview" src="{{ $update_product->product_image
                        ? asset('product_image/'.$update_product->product_image)
                        : asset('product_image/default.png') }}"
                        alt="{{ $update_product->product_name }}"
                        width="120"
                        style="border-radius:8px;">
                </div>
                {{-- New Image --}}
                <div class="form-group">
                    <label for="product_image">Change Image</label>
                    <input type="file" name="product_image" id="product_image" accept="image/*" onchange="previewImage(event)">
                </div>
                {{-- Submit --}}
                <div class="form-group">
                    <button type="submit">Update Product</button>
                </div>
            </form>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('product.layouts.footer')
    {{-- JS Section --}}
    @include('product.layouts.scripts')
</body>
</html>
