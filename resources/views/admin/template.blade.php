
@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">
    
@endpush

@push('scripts')
 
<script src="/admin_resources/vendors/js/vendor.bundle.base.js"></script>
<script src="/admin_resources/js/off-canvas.js"></script>
<script src="/admin_resources/js/hoverable-collapse.js"></script>
<script src="/admin_resources/js/template.js"></script>
<script src="/admin_resources/js/settings.js"></script>
<script src="/admin_resources/js/todolist.js"></script>
<!-- plugin js for this page -->
<script src="/admin_resources/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/admin_resources/vendors/chart.js/Chart.min.js"></script>
<!-- Custom js for this page-->
<script src="/admin_resources/js/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 
@endpush


@section('title', 'Admin - Manage Users')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

  

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Categories</span>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                    Add New Category
                </button>
            </div>
            <div class="card-body">
          
            </div>
        </div>
   
 


   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 