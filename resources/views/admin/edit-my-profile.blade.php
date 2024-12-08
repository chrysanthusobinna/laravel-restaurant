
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
                            <td><label for="name">Name</label></td>
                            <td><input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required></td>
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



 