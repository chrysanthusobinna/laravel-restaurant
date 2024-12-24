
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
    $(document).ready(function () {
        // Phone Number Modal
        function resetPhoneNumberModal() {
            $('#phoneNumberForm')[0].reset();
            $('#phoneNumberForm').attr('action', "{{ route('admin.phone-number.store') }}");
            $('#phoneNumberFormMethod').val('');
        }

        window.createPhoneNumber = function () {
            resetPhoneNumberModal();
            $('#phoneNumberModalLabel').text('Add Phone Number');
        };

        window.editPhoneNumber = function (id, phoneNumber, useWhatsapp) {
            resetPhoneNumberModal();
            $('#phone_number').val(phoneNumber);
            $('#use_whatsapp').prop('checked', useWhatsapp === 1); // Set checked if useWhatsapp is 1
            let actionUrl = "{{ route('admin.phone-number.update', ':id') }}".replace(':id', id);
            $('#phoneNumberForm').attr('action', actionUrl);
            $('#phoneNumberFormMethod').val('PUT');
            $('#phoneNumberModalLabel').text('Edit Phone Number');
        };

        // Address Modal
        function resetAddressModal() {
            $('#addressForm')[0].reset();
            $('#addressForm').attr('action', "{{ route('admin.address.store') }}");
            $('#addressFormMethod').val('');
        }

        window.createAddress = function () {
            resetAddressModal();
            $('#addressModalLabel').text('Add Address');
        };

        window.editAddress = function (id, address) {
            resetAddressModal();
            $('#address').val(address);
            let actionUrl = "{{ route('admin.address.update', ':id') }}".replace(':id', id);
            $('#addressForm').attr('action', actionUrl);
            $('#addressFormMethod').val('PUT');
            $('#addressModalLabel').text('Edit Address');
        };

        // Working Hour Modal
        function resetWorkingHourModal() {
            $('#workingHourForm')[0].reset();
            $('#workingHourForm').attr('action', "{{ route('admin.working-hour.store') }}");
            $('#workingHourId').val('');
        }

        window.createWorkingHour = function () {
            resetWorkingHourModal();
            $('#workingHourModalLabel').text('Add Working Hour');
        };

        window.editWorkingHour = function (id, workingHour) {
            resetWorkingHourModal();
            $('#working_hours').val(workingHour);
            let actionUrl = "{{ route('admin.working-hour.update', ':id') }}".replace(':id', id);
            $('#workingHourForm').attr('action', actionUrl);
            $('#workingHourId').val('PUT');
            $('#workingHourModalLabel').text('Edit Working Hour');
        };


          // Social Media Handle Modal
          function resetSocialMediaModal() {
            $('#socialMediaForm')[0].reset();
            $('#socialMediaForm').attr('action', "{{ route('admin.social-media-handles.store') }}");
            $('#handle').val('');
            $('#socialMediaFormMethod').val('');

        }

        window.createSocialMediaHandle = function () {
            resetSocialMediaModal();
            $('#socialMediaModalLabel').text('Add Social Media Handle');
        };

        window.editSocialMediaHandle = function (id, handle, socialMedia) {
            resetSocialMediaModal();
            $('#handle').val(handle);
            $('#social_media').val(socialMedia);
            let actionUrl = "{{ route('admin.social-media-handles.update', ':id') }}".replace(':id', id);
            $('#socialMediaForm').attr('action', actionUrl);
            $('#socialMediaFormMethod').val('PUT');
            $('#socialMediaModalLabel').text('Edit Social Media Handle');
        };      
 
    // Phone Number Delete
    window.deletePhoneNumber = function (id) {
        let actionUrl = "{{ route('admin.phone-number.delete', ':id') }}".replace(':id', id);
        $('#deletePhoneNumberForm').attr('action', actionUrl);
        $('#deletePhoneNumberModal').modal('show');
    };

    // Address Delete
    window.deleteAddress = function (id) {
        let actionUrl = "{{ route('admin.address.delete', ':id') }}".replace(':id', id);
        $('#deleteAddressForm').attr('action', actionUrl);
        $('#deleteAddressModal').modal('show');
    };

    // Working Hour Delete
    window.deleteWorkingHour = function (id) {
        let actionUrl = "{{ route('admin.working-hour.delete', ':id') }}".replace(':id', id);
        $('#deleteWorkingHourForm').attr('action', actionUrl);
        $('#deleteWorkingHourModal').modal('show');
    };


    // social media handle Delete
    window.deleteSocialMediaHandle = function (id) {
        let actionUrl = "{{ route('admin.social-media-handles.delete', ':id') }}".replace(':id', id);
        $('#deleteSocialMediaHandleForm').attr('action', actionUrl);
        $('#deleteSocialMediaHandleModal').modal('show');
    };
	



        // JavaScript for dynamic updates
        document.getElementById('country').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const timezone = selectedOption.getAttribute('data-timezone');
        const currencySymbol = selectedOption.getAttribute('data-currency-symbol');
        const currencyCode = selectedOption.getAttribute('data-currency-code');

        // Update timezone select
        const timezoneSelect = document.getElementById('timezone');
        timezoneSelect.innerHTML = `<option value="${timezone}" selected>${timezone}</option>`;
        timezoneSelect.disabled = false;

        // Update currency symbol and code
        document.getElementById('currencySymbol').value = currencySymbol || '';
        document.getElementById('currencyCode').value = currencyCode || '';
    });

});






</script>



 
 


@endpush


@section('title', 'Admin - Settings - General')




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
                <button type="button" class="btn btn-sm bg-white btn-icon-text border" onclick=" ">
                    <i class="typcn typcn-arrow-forward-outline mr-2"></i>Settings
                </button>
            </div>
            
     
          </div>
        </div>
      </div>

      <hr/>
      <h1>General Settings</h1>
      




      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Phone Numbers -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Restaurant Phone Numbers</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#phoneNumberModal" onclick="createPhoneNumber()">
                        <i class="fa fa-plus"></i> Add Phone Number
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Phone Number</th>
                                <th class="col-4 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="phoneNumbersTable">
                            @forelse($phoneNumbers as $phoneNumber)
                                <tr>
                                    <td>
                                        <i class="fa fa-phone" aria-hidden="true"></i> 
                                        {{ $phoneNumber->phone_number }}
                                        @if($phoneNumber->use_whatsapp == 1)
                                            <span class="badge bg-success"><i class="fab fa-whatsapp"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#phoneNumberModal" onclick="editPhoneNumber({{ $phoneNumber->id }}, '{{ $phoneNumber->phone_number }}', {{ $phoneNumber->use_whatsapp }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deletePhoneNumber({{ $phoneNumber->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No phone numbers available. Please add a new phone number.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Addresses -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Restaurant Addresses</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="createAddress()">
                        <i class="fa fa-plus"></i> Add Address
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Address</th>
                                <th class="col-4 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($addresses as $address)
                                <tr>
                                    <td>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> 
                                        {{ $address->address }}
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="editAddress({{ $address->id }}, '{{ $address->address }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteAddress({{ $address->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No addresses available. Please add a new address.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Social Media Handles -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Social Media Handles</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#socialMediaModal" onclick="createSocialMediaHandle()">
                        <i class="fa fa-plus"></i> Add Handle
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Handle</th>
                                <th>Social Media</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($socialMediaHandles as $handle)
                                <tr>
                                    <td>
                                        @if($handle->social_media === 'facebook')
                                            <i class="fab fa-facebook-square"></i>
                                        @elseif($handle->social_media === 'instagram')
                                            <i class="fab fa-instagram"></i>
                                        @elseif($handle->social_media === 'youtube')
                                            <i class="fab fa-youtube-square"></i>         
                                        @elseif($handle->social_media === 'tiktok')
                                            <i class="fab fa-tiktok"></i>                                        
                                        @else
                                            <i class="fa fa-globe"></i> 
                                        @endif
                                        {{ $handle->handle }}</td>
                                    <td>{{ ucfirst($handle->social_media) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#socialMediaModal" onclick="editSocialMediaHandle({{ $handle->id }}, '{{ $handle->handle }}', '{{ $handle->social_media }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteSocialMediaHandle({{ $handle->id }})"> <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No social media handles available. Please add new handles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 grid-margin stretch-card">
            <!-- Working Hours -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Restaurant Working Hours</span>
                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#workingHourModal" onclick="createWorkingHour()">
                        <i class="fa fa-plus"></i> Add Working Hours
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-8">Working Hour</th>
                                <th class="col-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workingHours as $workingHour)
                                <tr>
                                    <td>
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 
                                        {{ $workingHour->working_hours }}
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#workingHourModal" onclick="editWorkingHour({{ $workingHour->id }}, '{{ $workingHour->working_hours }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteWorkingHour({{ $workingHour->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No working hours available. Please add new working hours.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    





    
    <div class="row">
        <div class="col-lg-6 d-flex grid-margin stretch-card">
     
 
    <form method="POST" action="{{ $script ? route('admin.livechat.update', $script->id) : route('admin.livechat.store') }}">
        <div class="card">
            <div class="card-header">
                <span>{{ $script ? 'Edit Live Chat Script' : 'Add Live Chat Script' }}</span>
            </div>
            <div class="card-body">
                @csrf
                @if($script)
                    @method('PUT')
                @endif
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-exclamation-triangle"></i> <b>Please ensure you enter a valid live chat script code. Make sure the code is copied from a reliable third-party live chat provider.</b>
                </div>
                <hr/>
                <div class="form-group">
                    <label for="name">Live Chat Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Tawk.to" value="{{ $script->name ?? '' }}" required>
                </div>
                <div class="form-group mt-3">
                    <label for="script_code">Script Code</label>
                    <textarea class="form-control" id="script_code" name="script_code" rows="6" placeholder="Paste the script code here..." required>{{ $script->script_code ?? '' }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between mt-4">
                @if($script)
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete this script?')) { document.getElementById('form-delete-livechat').submit(); }">Remove Live Chat</button>
                @else
                    <button type="submit" class="btn btn-primary">Add Live Chat</button>
                @endif
            </div>
        </div>
    </form>
    @if($script)
        <form method="POST" id="form-delete-livechat" action="{{ route('admin.livechat.destroy', $script->id) }}">
            @csrf
            @method('DELETE')
        </form>
    @endif
        </div>
        <div class="col-lg-6 d-flex grid-margin stretch-card">
 
 
            <div class="card">
                <div class="card-header">
                    Select Country / Time Zone 
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <!-- Country Selection -->
                            <tr>
                                <td><strong>Country</strong></td>
                                <td>
                                    <select class="form-control" id="country">
                                        <option value="" selected disabled>Select a country</option>
                                        <option value="US" data-timezone="America/New_York" data-currency-symbol="$" data-currency-code="USD">United States</option>
                                        <option value="IN" data-timezone="Asia/Kolkata" data-currency-symbol="?" data-currency-code="INR">India</option>
                                        <option value="GB" data-timezone="Europe/London" data-currency-symbol="£" data-currency-code="GBP">United Kingdom</option>
                                        <option value="JP" data-timezone="Asia/Tokyo" data-currency-symbol="¥" data-currency-code="JPY">Japan</option>
                                        <option value="AU" data-timezone="Australia/Sydney" data-currency-symbol="A$" data-currency-code="AUD">Australia</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <!-- Timezone Selection -->
                            <tr>
                                <td><strong>Timezone</strong></td>
                                <td>
                                    <select class="form-control" id="timezone" readonly>
                                        <option value="" selected >Select a country first</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <!-- Currency Details -->
                            <tr>
                                <td><strong>Currency Symbol</strong></td>
                                <td>
                                    <input type="text" id="currencySymbol" class="form-control" placeholder="Currency Symbol" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Currency Code</strong></td>
                                <td>
                                    <input type="text" id="currencyCode" class="form-control" placeholder="Currency Code" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div> 
        </div>
      </div>

    

      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Customer Order Settings</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order-settings.update') }}" method="POST">
                @csrf
    
                <div class="form-group">
                    <label for="price_per_mile">Price per Mile ($)</label>
                    <input type="number" name="price_per_mile" id="price_per_mile" class="form-control" value="{{ $order_settings->price_per_mile ?? '' }}" step="0.01" required>
                </div>
    
                <div class="form-group">
                    <label for="distance_limit_in_miles">Distance Limit in Miles</label>
                    <input type="number" name="distance_limit_in_miles" id="distance_limit_in_miles" class="form-control" value="{{ $order_settings->distance_limit_in_miles ?? '' }}" required>
                </div>
    
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>






<div class="modal fade" id="socialMediaModal" tabindex="-1" aria-labelledby="socialMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="socialMediaForm" method="POST">
                @csrf
                <input type="hidden" id="socialMediaFormMethod" name="_method" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="socialMediaModalLabel">Social Media Handle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="handle" class="form-label">Handle</label>
                        <input type="text" class="form-control" id="handle" name="handle" required>
                    </div>
                    <div class="mb-3">
                        <label for="social_media" class="form-label">Social Media</label>
                        <select class="form-control" id="social_media" name="social_media" required>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="tiktok">TikTok</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>






    <div class="modal fade" id="phoneNumberModal" tabindex="-1" aria-labelledby="phoneNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="phoneNumberForm" method="POST">
                    @csrf
                    <input type="hidden" id="phoneNumberFormMethod" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="phoneNumberModalLabel">Phone Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Example: +44 123 456 7654" required>
                        </div>

 
                        
                        <div class="form-check form-check-flat form-check-primary">

                            <label class="form-check-label" for="use_whatsapp">
                            <input type="checkbox" class="form-check-input"  id="use_whatsapp" name="use_whatsapp" value="1">  Use WhatsApp <i class="input-helper"></i>
                            </label>
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    






    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addressForm" method="POST">
                    @csrf
                    <input type="hidden" id="addressFormMethod" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addressModalLabel">Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


    <div class="modal fade" id="workingHourModal" tabindex="-1" aria-labelledby="workingHourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="workingHourForm" method="POST">
                    @csrf
                    <input type="hidden" id="workingHourId" name="_method" value="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="workingHourModalLabel">Working Hour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="working_hours" class="form-label">Working Hour</label>
                            <input type="text" class="form-control" id="working_hours" name="working_hours" placeholder="e.g Mon to Sat - 9 AM to 10 PM" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    






    <div class="modal fade" id="deletePhoneNumberModal" tabindex="-1" aria-labelledby="deletePhoneNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePhoneNumberForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePhoneNumberModalLabel">Delete Phone Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this phone number?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    


    <div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteAddressForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAddressModalLabel">Delete Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this address?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
   






    <div class="modal fade" id="deleteWorkingHourModal" tabindex="-1" aria-labelledby="deleteWorkingHourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteWorkingHourForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteWorkingHourModalLabel">Delete Working Hour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this working hour?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteSocialMediaHandleModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteSocialMediaHandleForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAddressModalLabel">Delete social media handle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this social media handle?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 