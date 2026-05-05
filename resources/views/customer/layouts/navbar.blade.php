<nav class="navbar">
    {{-- Navbar Left --}}
    <div class="navbar-left">
        <h2>
            <i class="fa-solid fa-cart-shopping"></i> E-commerce
        </h2>
    </div>
    {{-- Navbar Right --}}
    <div class="navbar-right">
        @if(!session('login_id'))
            <a href="{{ route('register') }}" class="nav-auth-link">
                <i class="fa-solid fa-user-plus"></i> Register
            </a>
            <span class="nav-divider">|</span>
            <a href="{{ route('login') }}" class="nav-auth-link">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
            <span class="nav-divider">|</span>
        @else
            <span class="nav-auth-link">
                <i class="fa-solid fa-user"></i> {{ session('login_name') }}
            </span>
            <span class="nav-divider">|</span>
        @endif
        <a href="{{ route('view_cart') }}" class="cart-right">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Cart (<span id="cart-count">{{ array_sum(array_column(session('cart', []), 'quantity')) }}</span>)
        </a>
    </div>
</nav>