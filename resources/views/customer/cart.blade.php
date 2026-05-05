<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart - My Shop</title>
    {{-- Bootstrap CDN 5 --}}
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
        {{-- Main Content --}}
        <main class="main-content" style="flex: 1;">
            {{-- Back --}}
            <div class="mb-3">
                <a href="{{ route('index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-circle-left me-2" aria-hidden="true"></i>Back
                </a>
            </div>
            {{-- Heading --}}
            <h1 class="cart-title">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Your Cart
            </h1>
            {{-- Ajax Message --}}
            <div id="ajax-message"></div>
            {{-- Flesh message --}}
            @if(session('success'))
                <div id="success-alert" class="alert alert-success text-center">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="text-danger">{{ session('fail') }}</div>
            @endif
            {{-- Table Cart --}}
            @if(session('cart'))
                <div class="cart-wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $key => $item)
                                <tr id="row_{{ $key }}" data-price="{{ $item['price'] }}">
                                    <td>
                                        <img src="{{ asset('images/' . $item['image']) }}"
                                            alt="{{ $item['name'] }}" width="60" height="60"
                                            style="object-fit: cover; border-radius: 6px;">
                                    </td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['description'] ?? 'No description' }}</td>
                                    <td>${{ $item['price'] }}</td>
                                    <td class="item-total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <input type="number" class="qty-input" data-id="{{ $key }}" value="{{ $item['quantity'] }}" min="1">
                                    </td>
                                    <td class="actions-cell">
                                        {{-- Update --}}
                                        <button type="button" class="btn update-btn btn-update-ajax" data-id="{{ $key }}">
                                            <i class="fa fa-pencil-square"></i> Update
                                        </button>
                                        {{-- Delete --}}
                                        <button type="button" class="btn delete-btn btn-remove-ajax" data-id="{{ $key }}">
                                            <i class="fa fa-remove"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Total --}}
                <div class="cart-total">
                    <h3>Grand Total: <span class="amount" id="grand-total">${{ number_format ($grandTotal, 2) }}</span></h3>
                    @if(count($cart) > 0)
                        {{-- Confirm Order --}}
                        <a href="{{ route('confirm_order') }}" class="btn btn-success mt-3">
                            <i class="fa fa-check" aria-hidden="true"></i> Confirm Order
                        </a>
                        {{-- Delete All --}}
                        <button type="button" class="btn btn-danger mt-3 ms-2" id="btn-delete-all-cart">
                            <i class="fa fa-trash me-1" aria-hidden="true"></i> Delete All
                        </button>
                    @endif
                </div>
            @else
                <p class="empty-cart">Your cart is empty</p>
            @endif
        </main>
    </div>
    {{-- Footer Section --}}
    @include('customer.layouts.footer')
    {{-- JS Section --}}
    @include('customer.layouts.scripts')
</body>
</html>