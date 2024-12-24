
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
 


<script type="text/javascript">
    // Preview the selected image (Profile Photo)
    function previewImage() {
        var file = document.getElementById('profile_photo').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            document.getElementById('profile_preview').src = reader.result;
        };
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

@endpush


@section('title', 'Admin - Edit Profile')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

   
      <form action="{{ route('admin.myprofile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="card">
            <div class="card-header bg-info text-white">
                <i class="fa fa-user"></i>&nbsp; Edit Profile
            </div>
            <div class="card-body">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <!-- Profile Photo Preview -->
                    <div class="mb-3 text-center">
                        <label for="profile_preview">Preview</label><br>
                        <img id="profile_preview" 
                             src="{{ $user->profile_picture ? asset('storage/profile-picture/' . $user->profile_picture) : asset('assets/images/user-icon.png') }}" 
                             alt="Profile Preview" 
                             class="img-thumbnail" 
                             style="width: 150px; height: 150px;">
                        <br/>
                        <label for="profile_photo">Profile Photo</label>
                        <input type="file" class="form-control-file" id="profile_photo" name="profile_photo" style="padding:5px; border: 1px solid black;" accept="image/*" onchange="previewImage()">
                    </div>
                </div>
    
                <hr/>
                <table class="table table-bordered">
                    <tbody>
                        <!-- Name -->
                        <tr>
                            <td><label for="first_name">First Name</label></td>
                            <td><input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required></td>
                        </tr>
                        <tr>
                            <td><label for="middle_name">Middle Name</label></td>
                            <td><input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}"></td>
                        </tr>
                        <tr>
                            <td><label for="last_name">Last Name</label></td>
                            <td><input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required></td>
                        </tr>
                        
                        <!-- Email -->
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required></td>
                        </tr>
                        <!-- Phone Number -->
                        <tr>
                            <td><label for="phone_number">Phone Number</label></td>
                            <td><input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"></td>
                        </tr>
                        <!-- Address -->
                        <tr>
                            <td><label for="address">Address</label></td>
                            <td><input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Update Profile</button>
                <button type="button" onclick="window.location='{{ route('admin.view.myprofile') }}'" class="btn btn-danger float-right">Back</button>
            </div>
        </div>
    </form> 


   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 