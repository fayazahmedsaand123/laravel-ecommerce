<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product List</title>
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
        {{-- Main Content Section --}}
        <main class="main-content">
            <h1>Product List</h1>
            {{-- Flesh message --}}
            @if(session('success'))
                <div id="success-alert" class="success-message">{{ session('success') }}</div>
            @elseif(session('fail'))
                <div class="text-danger">{{ session('fail') }}</div>
            @endif
            {{-- Product Table --}}
            <table>
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th colspan="7">Actions</th>
                    </tr>   
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            {{-- <td>{{ $product->id }}</td> --}}
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price, 2 }}</td>
                            <td>{{ $product->product_description }}</td>
                            <td>
                                @if($product->product_image)
                                    <img src="{{ asset('product_image/'.$product->product_image) }}" alt="Product Image" class="product-img">
                                @else
                                    <img src="{{ asset('Default_image/'.$product->product_image) }}" alt="Default Image" class="product-img">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('view_product',$product->id) }}" class="btn-view">
                                    <i class="fa fa-eye"></i> 
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('update_product',$product->id) }}" class="btn-edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('delete_product',$product->id) }}" class="btn-delete deleteBtn" data-id="{{ $product->id }}">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-danger">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            {{-- Pagination --}}
            <div class="mt-3 pagination-left">{{ $products->links('pagination::bootstrap-5') }}</div>
        </main>
    </div>
    {{-- Footer Section --}}
    @include('product.layouts.footer')
    {{-- JS Section --}}
    @include('product.layouts.scripts')
</body>
</html>
