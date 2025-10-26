<nav class="navbar navbar-expand-lg"> 
    <a class="navbar-brand" href="{{ route('home') }}">
        <img class="logo_light" src="/assets/images/logo_light.png" alt="logo">
        <img class="logo_dark" src="/assets/images/logo_dark.png" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
        <span class="ion-android-menu"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li>  <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">Home</a> </li>
            <li>  <a href="{{ route('menu') }}" class="nav-link {{ Request::is('menu*') ? 'active' : '' }}">Menu</a> </li>
            <li>  <a href="{{ route('blogs') }}" class="nav-link {{ Request::is('blog*') ? 'active' : '' }}">Blogs</a> </li>
            <li>  <a href="{{ route('about') }}" class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}">About</a> </li>
            <li> <a href="{{ route('contact') }}" class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Contact</a> </li>

        </ul>
        
    </div>
    <ul class="navbar-nav attr-nav align-items-center">
        <li>
            <a class="nav-link account_trigger" href="#"><i class="linearicons-user"></i></a>
        </li>

        @auth
            @if (Auth::user()->role === 'customer')
                <li>
                    <a class="nav-link {{ Request::routeIs('cart') ? 'active' : '' }}" href="{{ route('customer.cart') }}">
                        <i class="linearicons-cart"></i>
                        <span class="cart_count" id="cart_count">{{ $customer_total_cart_items }}</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>

    @if($firstRestaurantPhoneNumber)  
    <div class="header_btn d-sm-block d-none">
        <a href="tel:{{ $firstRestaurantPhoneNumber->phone_number }}" class="btn btn-default rounded-0 ml-2 btn-sm"><i class="fa fa-phone"></i> CALL US</a>
    </div>  
    @endif

</nav>

