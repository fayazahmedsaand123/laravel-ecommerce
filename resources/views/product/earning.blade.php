<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Earnings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('Fas/product.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Navbar Section --}}
    @include('product.layouts.navbar')
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('product.layouts.sidebar')
        {{-- Main Content Section --}}
        <main class="main-content">
            <h1>
                <i class="fa fa-dollar" aria-hidden="true"></i> My Earnings
            </h1>
            {{-- Total Earnings --}}
            <h3>Total Earnings: ${{ number_format($totalEarnings, 2) }}</h3>
            @if($earnings->isEmpty())
                <div class="alert alert-warning mt-3">No sales yet.</div>
            @else
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Seller</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($earnings as $item)
                            <tr>
                                <td>{{ $item->order_id }}</td>

                                {{-- Product Image --}}
                                <td>
                                    @if($item->product)
                                        <img src="{{ asset('images/'. $item->product->image) }}" width="50" class="me-2">
                                    @else
                                        <span class="text-muted">Deleted Product</span>
                                    @endif
                                </td>

                                {{-- Product Name --}}
                                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>

                                {{-- Seller Name --}}
                                <td>{{ $item->seller->name ?? 'N/A' }}</td>

                                {{-- Price --}}
                                <td>${{ number_format($item->product->price ?? 0, 2) }}</td>

                                {{-- Quantity --}}
                                <td>{{ $item->quantity }}</td>

                                {{-- Subtotal --}}
                                <td>${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </main>
    </div>
    {{-- Footer Section --}}
    @include('product.layouts.footer')
    {{-- JS Section --}}
    @include('product.layouts.scripts')
</body>
</html>