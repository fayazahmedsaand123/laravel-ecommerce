<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Sellers | Admin</title>
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
        {{-- Main content section --}}
        <main class="main-content">
            <h2>
                <i class="fa-solid fa-users"></i> Manager Account
            </h2>
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="alert alert-danger">{{ session('fail') }}</div>
            @endif
            {{-- Seller Table --}}
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sellers as $seller)
                    <tr>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>
                            @if($seller->profile_image)
                                <img src="{{ asset('profile_images/'.$seller->profile_image) }}" alt="Profile Image" class="product-img">
                            @else
                                <img src="{{ asset('Default_image/'.$seller->profile_image) }}" alt="Default Image" class="product-img">
                            @endif
                        </td>
                        {{-- Role --}}
                        <td>
                            <span class="role-{{ $seller->role }}">
                                {{ ucfirst($seller->role) }}
                            </span>
                        </td>
                        {{-- Status --}}
                        <td>
                            <span class="status-{{ $seller->status }}">
                                {{ ucfirst($seller->status) }}
                            </span>
                        </td>
                        <td>
                            {{-- Make Admin --}}
                            @if($seller->role !== 'admin')
                                <form action="{{ route('admin_seller', $seller->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="button" class="btn-admin confirm-action">Make Admin</button>                                
                                </form>
                            @endif

                            {{-- Disable --}}
                            @if($seller->status !== 'disabled')
                                <form action="{{ route('admin_seller_disable', $seller->id) }}" method="POST" class="d-inline">
                                    @csrf
                                <button type="button" class="btn-disable confirm-action">Disable</button>                               
                             </form>
                            @endif
                            {{-- Enable --}}
                            @if($seller->status === 'disabled')
                                <form action="{{ route('admin_seller_enable', $seller->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="button" class="btn-enable confirm-action">Enable</button>                               
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-danger">No records found.</td>
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
