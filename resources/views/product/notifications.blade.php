<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller Notification</title>
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
                <i class="fa fa-bell" aria-hidden="true"></i> My Sales Notifications
            </h1>

            @if($notifications->count() == 0)
                <p>No sales yet.</p>
            @else
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $item)
                            <tr>
                                {{-- Product Name --}}
                                <td>{{ $item->product->name ?? 'N/A' }}</td>

                                {{-- Quantity --}}
                                <td>{{ $item->quantity }}</td>

                                {{-- Price --}}
                                <td>${{ number_format($item->product->price ?? 0, 2) }}</td>

                                {{-- Subtotal --}}
                                <td>${{ number_format($item->subtotal, 2) }}</td>

                                {{-- Date --}}
                                <td>{{ $item->created_at->format('d M Y') }}</td>
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