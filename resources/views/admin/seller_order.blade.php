<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller Orders</title>
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/admin.css') }}">
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Navbar Section --}}
    @include('admin.layouts.navbar')
    {{-- Container --}}
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('admin.layouts.sidebar')
        {{-- Back --}}
        <div style="margin-top:30px; margin-left:240px;">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
            </a>
        </div>
        {{-- Main Content Section --}}
        <main class="main-content">
            <h2>My Orders</h2>
            {{-- Seller Order Table --}}
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Seller Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->order ? $order->order->id : 'N/A' }}</td>
                        <td>{{ $order->product ? $order->product->name : 'Unknown Product' }}</td>
                        <td>{{ $order->seller ? $order->seller->name : 'Unknown Seller' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ number_format($order->price, 2) }}</td>
                        <td>${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-danger">No orders found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('admin.layouts.footer')
    {{-- JS Section --}}
    @include('admin.layouts.scripts')
</body>
</html>
