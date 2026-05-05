<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Detail</title>
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
            <h2>Order #{{ $order->id }}</h2>
            <p><strong>Total:</strong> ${{ $order->total_amount }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
            <table>
                <thead>
                    <tr>
                        <th>Seller Name</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->seller ? $item->seller->name : 'N/A' }}</td>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ $item->subtotal }}</td>
                    </tr>
                    @endforeach
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
