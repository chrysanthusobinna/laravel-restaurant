<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="/favicon_io/favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="/assets/images/logo_dashboard.png" alt="logo">
              </div>

              @yield('content')
            
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="/admin_resources/vendors/js/vendor.bundle.base.js"></script>
  <script src="/admin_resources/js/off-canvas.js"></script>
  <script src="/admin_resources/js/hoverable-collapse.js"></script>
  <script src="/admin_resources/js/template.js"></script>
  <script src="/admin_resources/js/settings.js"></script>
  <script src="/admin_resources/js/todolist.js"></script>
  @stack('script')
</body>
</html>
