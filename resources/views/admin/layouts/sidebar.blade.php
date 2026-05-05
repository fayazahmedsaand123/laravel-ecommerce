<aside class="sidebar">
    <ul>
        <li>
            {{-- Admin --}}
            <a href="{{ route('admin') }}"
                class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>
        <li>
            {{-- Seller --}}
            <a href="{{ route('seller') }}"
                class="{{ request()->routeIs('seller') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Manager Account
            </a>
        </li>       
        <li>
            {{-- Admin Order --}}
            <a href="{{ route('admin_order') }}"
                class="{{ request()->routeIs('admin_order') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice"></i> Admin Order
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('seller_order') }}"
                class="{{ request()->routeIs('seller_order') ? 'active' : '' }}">
                <i class="fa-solid fa-truck"></i> Seller Order
            </a>
        </li>  --}}
        <li>
            {{-- Customer List --}}
            <a href="{{ route('record_customer') }}"
                class="{{ request()->routeIs('record_customer') ? 'active' : '' }}">
                <i class="fa fa-user-circle" aria-hidden="true"></i> Customer
            </a>
        </li>
        <li>
            {{-- Logout --}}
            <a href="#" id="logoutBtn" class="logout-btn">
                <i class="fa fa-power-off"></i> Logout
            </a>
        </li>
    </ul>
</aside>