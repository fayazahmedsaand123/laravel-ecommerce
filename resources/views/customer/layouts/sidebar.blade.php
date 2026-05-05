<aside class="sidebar">
    <p style="margin-left: 40px; font-size:25px; font-weight: bold;">Menu</p>
    <ul>
        <li>
            <a href="{{ route('index') }}"
                class="{{ request()->routeIs('index') ? 'active' : '' }}">
                <i class="fa fa-home" aria-hidden="true"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('view_cart') }}"
                class="{{ request()->routeIs('view_cart') ? 'active' : '' }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> View Cart
            </a>
        </li>
    </ul>
</aside>