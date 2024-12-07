<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="/admin_resources/images/favicon.png" />
  </head>
  <body>
 
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="/admin_resources/images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/admin_resources/images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
 
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-flex  mr-2">  <a class="nav-link" href="#"> <i class="typcn typcn-user-outline mr-0"></i> Jonh PAul  </a> </li>
            <li class="nav-item d-none d-lg-flex  mr-2">  <a class="nav-link" href="{{ route('admin.logout') }}"> <i class="typcn typcn-power-outline mr-0"></i> Logout  </a> </li>
         
         

          </ul>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">


        @include('partials.admin.sidebar')
        
        @yield('content')

      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
 
    @stack('scripts')

 
  </body>
</html>