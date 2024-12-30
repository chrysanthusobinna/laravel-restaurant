
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
    $(document).ready(function() {
        // Edit Modal
        $('.edit-btn').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');
            let price = $(this).data('price');
            let category_id = $(this).data('category_id');
            
            let actionUrl = "{{ route('admin.menus.update', ':id') }}".replace(':id', id);

            $('#editName').val(name);
            $('#editDescription').val(description);
            $('#editPrice').val(price);
            $('#editCategory').val(category_id);
            $('#editForm').attr('action', actionUrl);
        });

        // Delete Modal
        $('.delete-btn').on('click', function() {
            let id = $(this).data('id');
            let actionUrl = "{{ route('admin.menus.destroy', ':id') }}".replace(':id', id);

            $('#deleteForm').attr('action', actionUrl);
        });
    });
</script>
 

<script>
    $(document).ready(function() {
        // When a thumbnail image is clicked
        $('.trigger-lightbox').click(function() {
            // Get the image URL from the data-image attribute
            var imageUrl = $(this).data('image');
            
            // Set the source of the modal image to the clicked image's URL
            $('#modalImage').attr('src', imageUrl);
        });
    });
</script>

@endpush


@section('title', 'Admin - Menu')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')

 
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Menus ({{ $categories->sum(fn($category) => $category->menus->count()) }})</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Menu
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($categories as $category)
                    <div class="col-md-12 mb-4">
                        <h4>CATEGORY: {{ $category->name }}</h4>
                        <hr style="border:1px solid #000">
                        <div class="table-responsive pt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:20%">Name</th>
                                        <th style="width:50%">Description</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category->menus as $menu)
                                        <tr>
                                            <td>
                                                <!-- Trigger for Lightbox Modal -->
                                                <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" width="50" class="img-thumbnail trigger-lightbox" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('storage/' . $menu->image) }}">  {{ $menu->name }}
                                            </td>
                                            <td>{{ $menu->description }}</td>
                                            <td>{!! $site_settings->currency_symbol !!}{{ $menu->price }}</td>
                                            <td>
                                                <button class="m-1 btn btn-primary btn-sm edit-btn"
                                                        data-id="{{ $menu->id }}"
                                                        data-name="{{ $menu->name }}"
                                                        data-description="{{ $menu->description }}"
                                                        data-price="{{ $menu->price }}"
                                                        data-category_id="{{ $menu->category_id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal">
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                </button>
                                                <button class="m-1 btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $menu->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
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
                @empty
                    <p>No categories available.</p>
                @endforelse
            </div>
        </div>
    </div>
    
  


<!-- Lightbox Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Menu Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="menu image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ({!! $site_settings->currency_symbol !!})</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="price" required>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        Recommended image size is <strong>500 x 400</strong>. Uploaded images will be cropped to Recommended size.
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="editDescription" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price ({!! $site_settings->currency_symbol !!})</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="editPrice" required>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        Recommended image size is <strong>500 x 400</strong>. Uploaded images will be cropped to Recommended size.
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="editImage">
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label">Category</label>
                        <select name="category_id" class="form-control" id="editCategory" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this menu?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
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



 