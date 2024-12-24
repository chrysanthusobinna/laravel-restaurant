
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


@section('title', 'Admin - Settings - Categories')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')


      <div class="card card-info">
        <div class="card-header">
            <i class="fa fa-user"></i> My Profile
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center">
                <!-- Profile Photo Preview -->
                <div class="mb-3 text-center">
                    <img src="{{ $user->profile_picture ? asset('storage/profile-picture/' . $user->profile_picture) : asset('assets/images/user-icon.png') }}" 
                         alt="Profile Preview" 
                         class="img-thumbnail" 
                         style="width: 150px; height: 150px;">
                </div>
            </div>
            <hr/>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><b>Name:</b></td>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Role:</b></td>
                        <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                    </tr>
                    <tr>
                        <td><b>Status:</b></td>
                        <td>
                            @if($user->status == 1)
                                <span class="badge bg-success"><i class="fa fa-check"></i> Active</span>
                            @else
                                <span class="badge bg-danger"><i class="fa fa-exclamation-triangle"></i> Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Notice:</b></td>
                        <td>{{ $user->notice ?? 'No notices at this time' }}</td>
                    </tr>
                    <tr>
                        <td><b>Phone Number:</b></td>
                        <td>{{ $user->phone_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><b>Address:</b></td>
                        <td>{{ $user->address ?? 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button type="button" onclick="window.location='{{ route('admin.myprofile.edit') }}'" class="btn btn-info">Edit My Profile</button>
            <button type="button" onclick="window.location='{{ route('admin.index') }}'" class="btn btn-primary float-right">Dashboard</button>
        </div>
    </div>

    
  


   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 