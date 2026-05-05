<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- CSS File --}}
    <link rel="stylesheet" href="{{ asset('Fas/admin.css') }}">
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Navbar --}}
    @include('admin.layouts.navbar')
    {{-- Container --}}
    <div class="dashboard-container">
        {{-- Sidebar Section --}}
        @include('admin.layouts.sidebar')
        {{-- Main Content --}}
        <main class="main-content">
            <h1 class="mb-3">Welcome Admin 👋</h1>
            <p class="mb-4">Use the sidebar to manage sellers.</p>
            {{-- ===== Dashboard Cards ===== --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="{{ route('seller') }}" class="text-decoration-none">
                        <div class="card text-white bg-primary p-4 shadow-lg text-center">
                            <i class="fa fa-users fa-2x mb-3"></i>
                            <h5>Total Users</h5>
                            <h2>{{ $totalUsers ?? 0 }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('record_customer') }}" class="text-decoration-none">
                        <div class="card text-white bg-success p-4 shadow-lg text-center">
                            <i class="fa fa-user fa-2x mb-3"></i>
                            <h5>Total Customer</h5>
                            <h2>{{ $totalCustomer ?? 0 }}</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin_order') }}" class="text-decoration-none">
                        <div class="card text-dark bg-warning p-4 shadow-lg text-center">
                            <i class="fa fa-shopping-cart fa-2x mb-3"></i>
                            <h5>Total Orders</h5>
                            <h2>{{ $totalOrders ?? 0 }}</h2>
                        </div>
                    </a>    
                </div>
            </div>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('admin.layouts.footer')
    {{-- JS Section --}}
    @include('admin.layouts.scripts')
</body>
</html>
