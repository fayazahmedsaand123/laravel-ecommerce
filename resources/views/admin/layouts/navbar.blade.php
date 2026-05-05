<nav class="navbar">   
    {{-- Navbar Left --}}
    <div class="navbar-left">
        <h2>
            <i class="fa-solid fa-user-shield"></i> Admin Panel
        </h2>
    </div>
    {{-- Navbar Right --}}
    <div class="navbar-right">
        @if(session()->has('login_id'))
            @php
                $admin = \App\Models\User::find(session('login_id'));
            @endphp
            {{-- Admin --}}
            <div class="admin-controls">
                {{-- Profile show --}}
                <div class="admin-profile showAdminProfile"
                    data-name="{{ $admin->name ?? 'Admin' }}"
                    data-email="{{ $admin->email ?? 'No Email' }}"
                    data-image="{{ $admin && $admin->profile_image 
                        ? asset('profile_images/'.$admin->profile_image) 
                        : asset('Default_image/user-default.png') }}">
                        <img src="{{ $admin && $admin->profile_image 
                        ? asset('profile_images/'.$admin->profile_image) 
                        : asset('Default_image/user-default.png') }}"
                        alt="Admin Profile">
                    <span class="admin-name">{{ $admin->name ?? 'Admin' }}</span>
                </div>
            </div>
        @endif
    </div>
</nav>