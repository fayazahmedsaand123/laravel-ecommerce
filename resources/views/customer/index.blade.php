<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Products</title>
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
    {{-- Container --}}
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('customer.layouts.sidebar')
        {{-- Main Content Section --}}
        <main class="main-content">
            {{-- Heading --}}
            <h1 class="cart-title">
                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> All Products
            </h1>
            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-danger text-center">
                    {{ session('fail') }}
                </div>
            @endif
            {{-- Ajax Message --}}
            <div id="ajax-message" class="alert alert-success text-center" style="display:none;"></div>
            {{-- Product List --}}
            <div class="product-container">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            {{-- Description --}}
                            <p class="product-description">{{ $product->description }}</p>
                            {{-- Price --}}
                            <p class="price">Price: ${{ number_format($product->price, 2) }}</p>
                            {{-- Form validation --}}
                            <form action="{{ route('products_cart_store') }}" class="add-to-cart-form" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                {{-- Plus & Minus --}}
                                <div class="qty-wrapper">
                                    <button type="button" class="qty-btn-minus qty-minus">-</button>
                                    <input type="number" name="quantity" class="qty-input" value="1" min="1" max="99">
                                    <button type="button" class="qty-btn-plus qty-plus">+</button>
                                </div>
                                {{-- Add to cart --}}
                                <div class="btn-wrapper">
                                    <button type="submit" class="add-form">Add to Cart</button>
                                {{-- <a href="{{ route('view_product_cart',$product->id) }}" class="view-btn">
                                    View
                                </a> --}}
                                {{-- View Cart --}}
                                    <a href="{{ route('view_cart') }}" class="view-btn">View Cart</a>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('customer.layouts.footer')
    {{-- JS Section --}}
    @include('customer.layouts.scripts')
</body>
</html>








{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Products</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS File -->
    <link rel="stylesheet" href="{{ asset('Fas/cartproduct.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Navbar Section -->
    @include('customer.layouts.navbar')

    <!-- Main Wrapper -->
    <div class="dashboard-container">

        <!-- Sidebar Section -->
        @include('customer.layouts.sidebar')

        <!-- Main Content Section -->
        <main class="main-content">

            <h1 class="cart-title">All Products</h1>

            <!-- Flash message -->
            @if(session('success'))
                <div id="success-alert" class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @elseif(session('fail'))
                <div class="alert alert-danger text-center">
                    {{ session('fail') }}
                </div>
            @endif


            // add button for delete all 
            <!-- AJAX message -->
            <div id="ajax-message" class="alert alert-success text-center" style="display:none;"></div>

            <!-- Product Container -->
            <div class="product-container">
                @foreach ($products as $product)

                <div class="product-card">

                    <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}">

                    <h3 class="product-name">{{ $product->name }}</h3>

                    <p class="product-description">{{ $product->description }}</p>

                    <p class="price">
                        Price: ${{ number_format($product->price, 2) }}
                    </p>

                    <form action="{{ route('products_cart_store') }}" class="add-to-cart-form" method="POST">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <input type="number" name="quantity" value="1">

                        <div class="button-group">
                            <button type="submit" class="add-form">Add to Cart</button>

                            <a href="{{ route('view_product_cart',$product->id) }}" class="view-btn">
                                View
                            </a>
                        </div>
                    </form>

                </div>

                @endforeach
            </div>

        </main>
    </div>

    <!-- Footer Section -->
    @include('customer.layouts.footer')

    <!-- JavaScript -->
    @include('customer.layouts.scripts')

</body>
</html>
--}}