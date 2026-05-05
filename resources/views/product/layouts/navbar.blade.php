<nav class="navbar">
    {{-- Navbar Left --}}
    <div class="navbar-left">
        <h2>
            <i class="fa-solid fa-cart-shopping"></i> E-commerce
        </h2>
    </div>
    {{-- Navbar Right --}}
    <div class="navbar-right">
        @if(session()->has('login_id'))
            @php
                $loggedUser = \App\Models\User::find(session('login_id'));
            @endphp
            <div class="user-controls">
                <div class="user-profile showProfile"
                    data-name="{{ $loggedUser->name ?? 'User' }}"
                    data-email="{{ $loggedUser->email ?? 'No Email' }}"
                    data-image="{{ $loggedUser && $loggedUser->profile_image 
                        ? asset('profile_images/'.$loggedUser->profile_image) 
                        : asset('Default_image/user-default.png') }}">
                    <img src="{{ $loggedUser && $loggedUser->profile_image 
                        ? asset('profile_images/'.$loggedUser->profile_image) 
                        : asset('Default_image/user-default.png') }}" alt="Profile">
                    <span class="user-name">{{ $loggedUser->name ?? 'User' }}</span>
                </div>
                <a href="#" id="logoutBtn" class="logout-btn">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </div>
        @else
            <div class="auth-links">
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
        @endif
    </div>
</nav>