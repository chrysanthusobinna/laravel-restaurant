
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


@section('title', 'Admin - View Order')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

    
      
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0 font-weight-bold">Logged in as Admin</h3>
          <p>Your last login: 21h ago from newzealand.</p>
        </div>
        <div class="col-sm-6">
          <div class="d-flex align-items-center justify-content-md-end">
            <div class="mb-3 mb-xl-0 pr-1">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border" onclick="window.location='{{ route('admin.index') }}'">
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>Dashboard
                </button>
            </div>
            
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <button disabled type="button" class="btn btn-sm bg-white btn-icon-text border"  >
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>Settings
                </button>
            </div>
            
     
          </div>
        </div>
      </div>


        <div class="card">

            
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Details </span>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal">Update Order</button>
          
            </div>
            <div class="card-body">
  
                <table class="table table-bordered">

                    <tr>
                        <th>Order No.</th>
                        <td>#{{ $order->order_no }}</td>
                    </tr>                   
                    <tr>
                        <th>Created at</th>
                        <td>{{ $order->created_at->format('g:i A -  j M, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Updated at</th>
                        <td>{{ $order->updated_at->format('g:i A -  j M, Y') }}</td>
                    </tr>                    
                    <tr>
                        <th>Total Price</th>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $order->payment_method }}</td>
                    </tr>                   
                    <tr>
                        <th>Order Type</th>
                        <td>{{ ucfirst($order->order_type) }}</td>
                    </tr>

                </table>
 
            </div>
        </div>
   


        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Items </span>
          
            </div>
            <div class="card-body">
  
                <table class="table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->orderItems as $item)
                            <tr>
                                <td><i class="fa fa-circle"></i> {{ $item->menu_name }}</td>
                                <td>x {{ $item->quantity }}</td>
                                <td>${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No items in this order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>





            </div>
        </div>
   



   
        <div class="row mt-4">
            <div class="col-lg-6 d-flex grid-margin stretch-card">
         
                <div class="card">
                    <div class="card-header">
                        <h5>User Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Table for User Info -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Created By:</strong></td>
                                    <td>
                                        @if($order->createdByUser)
                                            {{ $order->createdByUser->first_name . " " . $order->createdByUser->last_name }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Updated By:</strong></td>
                                    <td>
                                        @if($order->updatedByUser)
                                            {{ $order->updatedByUser->first_name . " " . $order->updatedByUser->last_name }}
                                        @else
                                            Not Available
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
        
            </div>
            <div class="col-lg-6 d-flex grid-margin stretch-card">
              
                <div class="card ">
                    <div class="card-header">
                        <h5>Customer Information</h5>
                    </div>
                    <div class="card-body">
                        @if($customer)
                            <!-- Customer Table -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>{{ $customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number:</strong></td>
                                        <td>{{ $customer->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address:</strong></td>
                                        <td>{{ $customer->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p><strong>N/A</strong> </p>
                        @endif
                    </div>
                </div>
                
           
            </div>
          </div>
     
















        <!-- Update Order Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Order Status</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="orderStatus">Order Status</label>
                                <select class="form-control" id="orderStatus" name="status">
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 