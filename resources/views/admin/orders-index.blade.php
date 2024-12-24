
@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">
    <!-- DataTables   CSS -->

    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/admin_resources/css/small-box.css">
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

 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 

<script type="text/javascript">
    $(function () {
          
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin.orders.index', ['filter' => $filter]) }}",
          columns: [
            { data: 'order_no', name: 'order_no' },
            { data: 'created_at', name: 'created_at' },
            { data: 'total_price', name: 'total_price' },
            { data: 'status', name: 'status' },
            { data: 'order_type', name: 'order_type' },
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
          
    });
  </script>
@endpush


@section('title', 'Admin - Manage Orders')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
    @include('partials.message-bag')

    @include('partials.order-stats')

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $filter }} Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="orders-table">
                    <thead>
                        <tr>
                            <th>Order No.</th>
                            <th>Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Order Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 