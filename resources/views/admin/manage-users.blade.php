
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

    function editUser(button) {

        let user = $(button).data(); // Extract all data-* attributes into an object

        let actionUrl = "{{ route('admin.users.update', ':id') }}".replace(':id', user.id);
        $('#editUserForm').attr('action', actionUrl);

        $('#editFirstName').val(user.firstName);  
        $('#editMiddleName').val(user.middleName || '');  
        $('#editLastName').val(user.lastName);
        $('#editEmail').val(user.email);
        $('#editRole').val(user.role);

        if (user.notice === 'change_password_to_activate_account') {
            $('#banCheckboxDiv').hide();
        } else {
         
            $('#banCheckboxDiv').show();
            $('#banCheckbox').prop('checked', user.status === 0); 
        }
    }


    // Attach event listener to the modal
    $('#viewUserModal').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract data from the button's data-* attributes
        var first_name = button.data('first_name');
        var middle_name = button.data('middle_name');
        var last_name = button.data('last_name');
        var email = button.data('email');
        var role = button.data('role');
        var status = button.data('status');
        var phoneNumber = button.data('phone-number');
        var address = button.data('address');
        var profilePicture = button.data('profile-picture');

        // Update the modal content
        var modal = $(this);
        modal.find('#viewProfilePicture').attr('src', profilePicture || "{{ asset('assets/images/user-icon.png') }}");
        modal.find('#viewFirstName').text(first_name);
        modal.find('#viewMiddleName').text(middle_name);
        modal.find('#viewLastName').text(last_name);
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
 
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Manage Admin ({{ $users->count() }})</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">Add Admin</button>
        </div>
        <div class="card-body">
            @if($users->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No admin records found.
                </div>
            @else
                <table class="table">
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
                                <td><i class='fa fa-user'></i>&nbsp; {{ $user->first_name }}  {{ $user->middle_name ? $user->middle_name . ' ' : '' }}  {{ $user->last_name }}</td>
                                
                                <td>{{ $user->email }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                                <td>
                                    @if($user->status === 1)
                                        <span class="badge bg-success"><i class="fa fa-check"></i></span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                                    @endif
                                </td>
                                <td>
                                    <button 
                                    class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewUserModal" 
                                    data-first_name="{{ $user->first_name }}" 
                                    data-middle_name="{{ $user->middle_name }}" 
                                    data-last_name="{{ $user->last_name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ ucwords(str_replace('_', ' ', $user->role)) }}"
                                    data-status="{{ $user->status }}"
                                    data-phone-number="{{ $user->phone_number }}"
                                    data-address="{{ $user->address }}"
                                    data-profile-picture="{{ $user->profile_picture ? asset('storage/profile-picture/' . $user->profile_picture) : asset('assets/images/user-icon.png') }}"
                                    > <i class="fa fa-eye"></i>  </button>

                                    <button 
                                    class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editUserModal"
                                    data-id="{{ $user->id }}"
                                    data-first-name="{{ $user->first_name }}"
                                    data-middle-name="{{ $user->middle_name }}"
                                    data-last-name="{{ $user->last_name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ $user->role }}"
                                    data-status="{{ $user->status }}"
                                    data-notice="{{ $user->notice }}"
                                    onclick="editUser(this)">
                                    <i class='fa fa-edit'></i>
                                    </button>
                                                           
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
                        <label>First Name</label>
                        <input type="text" name="first_name" id="FirstName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" id="MiddleName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="LastName" class="form-control" required>
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
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="editFirstName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" id="editMiddleName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="editLastName" class="form-control" required>
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
                    <div class="form-check form-check-flat form-check-primary" id="banCheckboxDiv">
                        <label class="form-check-label" for="banCheckbox">
                            <input type="checkbox" class="form-check-input" id="banCheckbox" name="ban"> Ban User
                            <i class="input-helper"></i>
                        </label>
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
                        <th>First Name</th>
                        <td id="viewFirstName"></td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td id="viewMiddleName"></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td id="viewLastName"></td>
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
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 