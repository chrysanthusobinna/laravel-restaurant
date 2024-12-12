
@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">

<!-- DataTables   CSS -->

    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    
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
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
<!-- DataTables JS  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable for the menu table
        $('#menu-table').DataTable({
            "paging": true,        
            "searching": true,      
            "ordering": false,      
            "info": false,          
            "lengthChange": false, 
            "processing": true,     
            "bPaginate": true,      
            "bSort": false,         
     
        });
    });
</script>

<script>  

$(document).ready(function () {
    // Function to add item to cart
    function addToCart(id, name, price) {
        $.post('{{ route('admin.cart.add') }}', {  _token: "{{ csrf_token() }}", id: id, name: name, price: price }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
 
            }
        });
    }

    // Function to remove item from cart
    function removeFromCart(id) {
        $.post('{{ route('admin.cart.remove') }}', {  _token: "{{ csrf_token() }}", id: id }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
            }
        });
    }

    // Function to clear cart
    $('#clear-cart').click(function () {
        $.post('{{ route('admin.cart.clear') }}', { _token: "{{ csrf_token() }}", }, function (data) {
            if (data.success) {
                updateCartUI([]);
            }
        });
    });

    // Update cart UI
    function updateCartUI(cart) {
        var cartContainer = $('#cart-container');
        cartContainer.empty(); // Clear existing cart

        var total = 0;
        $.each(cart, function (index, item) {
            var subtotal = item.quantity * item.price;
            total += subtotal;

            cartContainer.append(`
                <tr class="cart-item">
                    <td>${item.name}</td>
                    <td>$${item.price}</td>
                    <td><input type="number" style="width:30%;" value="${item.quantity}" min="1" data-id="${item.id}" class="quantity-input"></td>
                    <td>$${subtotal}</td>
                    <td><button class="btn btn-danger btn-sm remove-btn" data-id="${item.id}"> <i class="fa fa-times" aria-hidden="true"></i></button></td>
                </tr>
            `);
        });

        if(total > 0){
        $('#clear-cart').show(); // Show Clear Cart button
        } else {
            $('#clear-cart').hide(); // Hide Clear Cart button
        }

        // Display the total
        $('#cart-total').text('Total: $' + total);

        // listener to remove buttons
        $('.remove-btn').click(function () {
            var id = $(this).data('id');
            removeFromCart(id);
        });

      // listener to quantity inputs
      $('.quantity-input').change(function () {
          var id = $(this).data('id');
          var newQuantity = $(this).val();
          updateCartQuantity(id, newQuantity);
      });

    }

    // Attach addToCart function to buttons
    $('.add-to-cart').click(function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        addToCart(id, name, price);
    });


      // Function to update cart quantity
    function updateCartQuantity(id, quantity) {
        $.post('{{ route('admin.cart.update')  }}', { 
            _token: "{{ csrf_token() }}", 
            id: id, 
            quantity: quantity 
        }, function (data) {
            if (data.success) {
                updateCartUI(data.cart);
            }
        });
    }



    // Initial fetch of cart items
    $.get('{{ route('admin.cart.view') }}', function (data) {
        updateCartUI(data.cart);
    });
});






document.querySelector('[data-bs-toggle="collapse"]').addEventListener('click', function () {
    const icon = this.querySelector('.toggle-icon');
    if (icon.classList.contains('fa-plus')) {
        icon.classList.remove('fa-plus');
        icon.classList.add('fa-minus');
    } else {
        icon.classList.remove('fa-minus');
        icon.classList.add('fa-plus');
    }
});


</script>
 

@endpush


@section('title', 'Admin - POS')




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
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>POS
                </button>
            </div>
            
     
          </div>
        </div>
      </div>

    

   



      <div class="row">
        <div class="col-lg-6 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">Menus</h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table" id="menu-table">
                        <thead style="display: none;">
                            <tr>
                                <th>Menu Item</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                      <tbody>
                        @forelse ($menus as $menu)
                        <tr>
                            <td>
                                <!-- Trigger for Lightbox Modal -->
                                <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" width="50" class="img-thumbnail trigger-lightbox" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('storage/' . $menu->image) }}">  {{ $menu->name }}
                            </td>
                            <td>${{ $menu->price }}</td>
                            <td>
     
                                <button class="m-1 btn btn-secondary btn-sm add-to-cart"
                                data-id="{{ $menu->id }}"
                                data-name="{{ $menu->name }}"
                                data-price="{{ $menu->price }}" >
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No menus available.</td>
                        </tr>
                    @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-lg-6 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div style="margin-top:40px;" class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Cart</h4>
              </div>
 


              <table class="table table-striped" id="cart-container">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cart items will be inserted here -->
                </tbody>
            </table>
            <hr/>
            <div id="cart-total" class="mt-3"></div>
            <hr/>

 


            </div>
            <div class="card-footer">
              <button id="clear-cart" style="display: none;" class="btn-block btn btn-warning mt-3"> Clear Cart</button>

            </div>

          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body">
          <form id="checkout-form" method="POST" action="{{ route('admin.cart.submit') }}">
            @csrf
              <div class="mt-4">
                  <!-- Toggle Button -->
                  <button class="btn btn-outline-secondary btn-fw mb-2 btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleTable" aria-expanded="false" aria-controls="collapsibleTable">
                    <i class="fa fa-plus toggle-icon"></i> Customer Details
                </button>
                

                  <!-- Collapsible Table -->
                  <div class="collapse" id="collapsibleTable">
                      <table class="table table-bordered">
                          <tbody>
                              <tr>
                                  <td><strong>Name</strong></td>
                                  <td><input type="text" class="form-control" id="name" name="name"></td>
                              </tr>
                              <tr>
                                  <td><strong>Email</strong></td>
                                  <td><input type="email" class="form-control" id="email" name="email"></td>
                              </tr>
                              <tr>
                                  <td><strong>Phone Number</strong></td>
                                  <td><input type="text" class="form-control" id="phone_number" name="phone_number"></td>
                              </tr>
                              <tr>
                                  <td><strong>Address</strong></td>
                                  <td><input type="text" class="form-control" id="address" name="address"></td>
                              </tr>
             
                          </tbody>
                      </table>
                  </div>
              </div>

              <hr>
              <table class="table table-bordered">
                <tbody>
 
                    <tr>
                        <td><strong>Payment Method</strong></td>
                        <td>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Select a payment method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>


            </form>
        </div>
        <div class="card-footer text-right">
            <button type="submit" form="checkout-form" class="btn btn-primary">Checkout</button>
            <button type="reset" form="checkout-form" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    
 


    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com</a> 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard </a>templates from Bootstrapdash.com</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
@endsection



 