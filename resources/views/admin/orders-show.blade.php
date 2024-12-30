
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
 
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="/admin_resources/css/small-box.css">


<script>
    $(document).ready(function() {
        $('#copy_session_id').click(function() {
            var sessionIdInput = $('#session_id');

            sessionIdInput.select();
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
            $('#copy-alert').fadeIn();
            setTimeout(function() {
                $('#copy-alert').fadeOut();
            }, 3000);
        });
    });
</script>

@endpush


@section('title', 'Admin - View Order')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

      @include('partials.order-stats')

        @if(!is_null($order->status_online_pay) && $order->status_online_pay == 'unpaid')
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <div>
                This order payment has not been confirmed.
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Details - #{{ $order->order_no }} </span>

                @if ($order->status_online_pay == 'paid' || is_null($order->status_online_pay))
                    @if ($order->status !== 'completed' && $order->status !== 'cancelled')
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal">Update Order</button>
                    @endif
                @endif
            
        
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered mt-2">    
                            <tr>
                                <th>Order No.</th>
                                <td>#{{ $order->order_no }}</td>
                            </tr>                               
                 
                            <tr>
                                <th>Total Paid</th>
                                <td>{!! $site_settings->currency_symbol !!}{{ number_format($order->total_price + ($order->delivery_fee ?? 0), 2) }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Fee</th>
                                <td>{{ $order->delivery_fee === null ? 'N/A' : html_entity_decode($site_settings->currency_symbol) . number_format($order->delivery_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Distance</th>
                                <td> {{ $order->delivery_distance === null ? 'N/A' : $order->delivery_distance . ' miles' }}</td>                              
                            </tr>
                            <tr>
                                <th>Price Per Mile</th>
                                <td> {{ $order->price_per_mile === null ? 'N/A' : html_entity_decode($site_settings->currency_symbol) . number_format($order->price_per_mile,2) }}</td>                              
                            </tr>
                            
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered mt-2">     
                            <tr>
                                <th>Created At</th>
                                <td>{{ $order->created_at->format('g:i A -  j M, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $order->updated_at->format('g:i A -  j M, Y') }}</td>
                            </tr>                             
                            <tr>
                                <th>Payment Method</th>
                                <td>{{ $order->payment_method }}</td>
                            </tr>              
                            <tr>
                                <th>Order Type</th>
                                <td>{{ ucfirst($order->order_type) }}</td>
                            </tr>                  

                            <tr>
                                <th>Status</th>
                                <td>


                                    @if(!is_null($order->status_online_pay) && $order->status_online_pay === 'unpaid')
                                    <span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i> unpaid</span>
                                    @else
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i> {{ ucfirst($order->status) }}</span>
                                                @break
                                            @case('completed')
                                                <span class="badge badge-success"><i class="fa fa-check"></i> {{ ucfirst($order->status) }}</span>
                                                @break
                                            @default
                                                {{ ucfirst($order->status) }}
                                        @endswitch
                                    @endif
                                                     
                                </td>
                                
                            </tr>
                        </table>
                    </div>
                </div>

                @if (!is_null($order->session_id))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="copy-alert" style="display: none;">
                        SESSION ID COPIED TO CLIPBOARD
                    </div>

                    <div class="form-group mt-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Payment Session ID:</span>
                              </div>
                            <input type="text" class="form-control" id="session_id" value="{{ $order->session_id }}" readonly>
                            <div class="input-group-append">
                                <button id="copy_session_id" class="btn btn-sm btn-light" type="button">
                                    <i class="fa fa-copy"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                @endif


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
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td><i class="fa fa-circle"></i> {{ $item->menu_name }}</td>
                                <td>x {{ $item->quantity }}</td>
                                <td>{!! $site_settings->currency_symbol !!}{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr style="border:2px solid #000">
                            <td><b>TOTAL</b></td>
                            <td> </td>
                            <td><b>{!! $site_settings->currency_symbol !!} {{ number_format($order->total_price, 2)  }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $order->additional_info   ? '<span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i> Additional Info:</span>  ' . e($order->additional_info)    : '' !!}
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
                        @if($order->customer)
                            <!-- Customer Table -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Name:</strong></td>
                                        <td>{{ $order->customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ $order->customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number:</strong></td>
                                        <td>{{ $order->customer->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address:</strong></td>
                                        <td>{{ $order->customer->address }}</td>
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



 