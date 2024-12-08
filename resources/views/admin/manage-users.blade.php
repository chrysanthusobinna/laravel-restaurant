
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


<script>
function editUser(user) {
    $('#editUserForm').attr('action', `/admin/users/${user.id}`);
    $('#editName').val(user.name);
    $('#editEmail').val(user.email);
    $('#editRole').val(user.role);
    $('#banCheckbox').prop('checked', user.status === 0);
}

    // Attach event listener to the modal
    $('#viewUserModal').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract data from the button's data-* attributes
        var name = button.data('name');
        var email = button.data('email');
        var role = button.data('role');
        var status = button.data('status');
        var phoneNumber = button.data('phone-number');
        var address = button.data('address');
        var profilePicture = button.data('profile-picture');

        // Update the modal content
        var modal = $(this);
        modal.find('#viewProfilePicture').attr('src', profilePicture || "{{ asset('assets/images/user-icon.png') }}");
        modal.find('#viewName').text(name);
        modal.find('#viewEmail').text(email);
        modal.find('#viewRole').text(role);
        modal.find('#viewStatus').html(status === 1 
            ? '<span class="badge bg-success"><i class="fa fa-check"></i> Active</span>' 
            : '<span class="badge bg-danger"><i class="fa fa-exclamation"></i> Banned</span>');
        modal.find('#viewPhoneNumber').text(phoneNumber || 'N/A');
        modal.find('#viewAddress').text(address || 'N/A');
    });

</script>
 
@endpush


@section('title', 'Admin - Manage Users')




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
            <span>Manage Admin</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">Add Admin</button>
        </div>
        <div class="card-body">
            @if($users->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No admin records found.
                </div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><i class='fa fa-user'></i>&nbsp;{{ $user->first_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                                <td>
                                    @if($user->status === 1)
                                        <span class="badge bg-success"><i class="fa fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-warning"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <button 
                                    class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewUserModal" 
                                    data-name="{{ $user->first_name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ ucwords(str_replace('_', ' ', $user->role)) }}"
                                    data-status="{{ $user->status }}"
                                    data-phone-number="{{ $user->phone_number }}"
                                    data-address="{{ $user->address }}"
                                    data-profile-picture="{{ $user->profile_picture ? asset('storage/profile-picture/' . $user->profile_picture) : asset('assets/images/user-icon.png') }}"
                                    > <i class="fa fa-eye"></i>  </button>

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="editUser({{ $user }})"><i class='fa fa-edit'></i></button>
                           
                                </td>
                            </tr>
                        @endforeach
                    </tbody>                    
                </table>
            @endif
        </div>
    </div>
    
   
 











<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-triangle"></i> The password will be the user's email address. The user should log in with this credential and change their password to gain access to the admin panel.
                    </div>
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control form-control-sm" required>
                            <option value="admin">Admin</option>
                            <option value="global_admin">Global Admin</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editUserForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" id="editRole" class="form-control form-control-sm form-select" required>
                            <option value="admin">Admin</option>
                            <option value="global_admin">Global Admin</option>
                        </select>
                    </div>
                    <div class="form-check form-check-flat form-check-primary">

                        <label class="form-check-label" for="use_whatsapp">
                        <input type="checkbox" class="form-check-input" id="banCheckbox" name="ban"  >  Ban User <i class="input-helper"></i>
                        <i class="input-helper"></i></label>
                    
                    </div>
       
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade" id="viewUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <!-- Profile Image -->
                    <img id="viewProfilePicture" src="{{ asset('assets/images/user-icon.png') }}" 
                         alt="Profile Image" 
                         class="img-thumbnail" 
                         style="width: 100px; height: 100px;">
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td id="viewName"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="viewEmail"></td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td id="viewRole"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="viewStatus"></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td id="viewPhoneNumber"></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td id="viewAddress"></td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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



 