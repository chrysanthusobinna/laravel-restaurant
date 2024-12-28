
@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">
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
<script src="/admin_resources/js/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Include jQuery and DataTables JS -->

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable({
                paging: true,
                searching: true,
                lengthChange: false,   
                pageLength: 10,       
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search orders..."
                }
            });
        });
    </script>


<script>
    $(document).ready(function() {

        // View Button Logic
        $('.view-btn').click(function() {
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let date = $(this).data('date');
            let time = $(this).data('time');
            let persons = $(this).data('persons');

            $('#viewName').val(name);
            $('#viewEmail').val(email);
            $('#viewPhone').val(phone);
            $('#viewDate').val(date);
            $('#viewTime').val(time);
            $('#viewPersons').val(persons);
        });
        
        
        // Edit Button Logic
        $('.edit-btn').click(function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let date = $(this).data('date');
            let time = $(this).data('time');
            let persons = $(this).data('persons');

            $('#editName').val(name);
            $('#editEmail').val(email);
            $('#editPhone').val(phone);
            $('#editDate').val(date);
            $('#editTime').val(time);
            $('#editPersons').val(persons);

            let actionUrl = "{{ route('admin.table-bookings.update', ':id') }}".replace(':id', id);
            $('#editForm').attr('action', actionUrl);
        });

        // Delete Button Logic
        $('.delete-btn').click(function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#deleteName').text(name);

            let actionUrl = "{{ route('admin.table-bookings.destroy', ':id') }}".replace(':id', id);
            $('#deleteForm').attr('action', actionUrl);
        });
    });
</script>

   

@endpush


@section('title', 'Admin - Settings - Categories')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

    
 


      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Manage Table Bookings ({{ $tableBookings->count() }})</span>
            <button class="btn btn-primary" data-toggle="modal" data-target="#createModal">Create Booking</button>
        </div>
        <div class="card-body">
            <table class="table"  id="orders-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tableBookings as $tableBookings)
                        <tr>
                            <td>{{ $tableBookings->name }}</td>
                            <td>{{ $tableBookings->email }}</td>
                            <td>{{ $tableBookings->time }} {{ $tableBookings->date }}</td>
                            <td>

                                <!-- View Button -->
                                <button class="btn btn-info btn-sm view-btn" data-toggle="modal" data-target="#viewModal"
                                    data-id="{{ $tableBookings->id }}"
                                    data-name="{{ $tableBookings->name }}"
                                    data-email="{{ $tableBookings->email }}"
                                    data-phone="{{ $tableBookings->phone }}"
                                    data-date="{{ $tableBookings->date }}"
                                    data-time="{{ $tableBookings->time }}"
                                    data-persons="{{ $tableBookings->persons }}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <!-- Edit Button -->
                                <button class="btn btn-warning btn-sm edit-btn" data-toggle="modal" data-target="#editModal" 
                                    data-id="{{ $tableBookings->id }}"
                                    data-name="{{ $tableBookings->name }}"
                                    data-email="{{ $tableBookings->email }}"
                                    data-phone="{{ $tableBookings->phone }}"
                                    data-date="{{ $tableBookings->date }}"
                                    data-time="{{ $tableBookings->time }}"
                                    data-persons="{{ $tableBookings->persons }}">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{ $tableBookings->id }}"
                                    data-name="{{ $tableBookings->name }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No table bookings.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
 
    
    





<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="viewName">Name</label>
                    <input type="text" class="form-control" id="viewName" readonly>
                </div>
                <div class="form-group">
                    <label for="viewEmail">Email</label>
                    <input type="email" class="form-control" id="viewEmail" readonly>
                </div>
                <div class="form-group">
                    <label for="viewPhone">Phone</label>
                    <input type="text" class="form-control" id="viewPhone" readonly>
                </div>
                <div class="form-group">
                    <label for="viewDate">Date</label>
                    <input type="date" class="form-control" id="viewDate" readonly>
                </div>
                <div class="form-group">
                    <label for="viewTime">Time</label>
                    <input type="text" class="form-control" id="viewTime" readonly>
                </div>
                <div class="form-group">
                    <label for="viewPersons">Persons</label>
                    <input type="number" class="form-control" id="viewPersons" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin.table-bookings.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="persons">Persons</label>
                        <input type="number" class="form-control" id="persons" name="persons" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>
    


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="editDate">Date</label>
                        <input type="date" class="form-control" id="editDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="editTime">Time</label>
                        <input type="text" class="form-control" id="editTime" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="editPersons">Persons</label>
                        <input type="number" class="form-control" id="editPersons" name="persons" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>

    
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this booking?</p>
                    <p id="deleteName"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>




   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')
  </div>
  <!-- main-panel ends -->
@endsection



 