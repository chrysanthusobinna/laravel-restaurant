<nav class="navbar navbar-expand-lg"> 
    <a class="navbar-brand" href="index.html">
        <img class="logo_light" src="assets/images/logo_light.png" alt="logo">
        <img class="logo_dark" src="assets/images/logo_dark.png" alt="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"> 
        <span class="ion-android-menu"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li>  <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">Home</a> </li>
            <li>  <a href="{{ route('menu') }}" class="nav-link {{ Request::routeIs('menu') ? 'active' : '' }}">Menu</a> </li>
            <li>  <a href="{{ route('about') }}" class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}">About {{ config('site.name') }}</a> </li>
            <li> <a href="{{ route('contact') }}" class="nav-link {{ Request::routeIs('contact') ? 'active' : '' }}">Contact Us</a> </li>
        </ul>
        
    </div>
    <ul class="navbar-nav attr-nav align-items-center">
        <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="linearicons-magnifier"></i></a> @include('partials.search') </li>
        <li><a class="nav-link {{ Request::routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}" ><i class="linearicons-cart"></i><span class="cart_count">2</span></a></li>
    </ul>
    <div class="header_btn d-sm-block d-none">
        <a href="book-table.html" class="btn btn-default rounded-0 ml-2 btn-sm">Order Online</a>
    </div>
</nav>