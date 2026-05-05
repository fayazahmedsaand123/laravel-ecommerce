<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer</title>
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
            <h2>All Customer</h2>
            {{-- Customer Table --}}
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>first name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>address</th>
                        <th>Date</th>
                        <th colspan="12">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>#{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                        <td>
                            {{-- Delete button --}}
                            <a href="{{ route('delete_customer', $customer->id) }}" class="delete-customer" data-id="{{ $customer->id }}">
                                <i class="fa fa-remove" aria-hidden="true"></i>
                            </a>
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