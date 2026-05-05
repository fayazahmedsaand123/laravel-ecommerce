<aside class="sidebar">
    <ul>
        <li>
            <a href="{{ route('record_product') }}"
                class="{{ request()->routeIs('record_product') ? 'active' : '' }}">
                <i class="fa-solid fa-shop"></i> Products
            </a>
        </li>
        <li>
            <a href="{{ route('product') }}"
                class="{{ request()->routeIs('product') ? 'active' : '' }}">
                <i class="fa-solid fa-plus"></i> Add Product
            </a>
        </li>
        <li>
            <a href="{{ route('earning') }}"
                class="{{ request()->routeIs('earning') ? 'active' : '' }}">
                <i class="fa fa-dollar-sign"></i> Earning
            </a>
        </li>
        <li>
            <a href="{{ route('seller_notification') }}"
            class="{{ request()->routeIs('seller_notification') ? 'active' : '' }}">
            <i class="fa fa-bell me-2"></i> My Sales
            </a>
        </li>
    </ul>
</aside>