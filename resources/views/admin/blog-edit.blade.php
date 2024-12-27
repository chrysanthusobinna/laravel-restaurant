
@extends('layouts.admin')

@push('styles')
    <!-- base:css -->
    <link rel="stylesheet" href="/admin_resources/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/admin_resources/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin_resources/css/vertical-layout-light/style.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    
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

    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imageUrl = button.data('image');
        $('#modalImage').attr('src', imageUrl);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var blogId = button.data('id');
        var blogName = button.data('name');
        var actionUrl = '/admin/blog/' + blogId;
        $('#deleteForm').attr('action', actionUrl);
        $('#deleteCategoryName').text(blogName);
    });

    $('.edit-btn').on('click', function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var content = $(this).data('content');
        var image = $(this).data('image');
        var actionUrl = "{{ route('admin.blog.update', ':id') }}".replace(':id', id);
        $('#editForm').attr('action', actionUrl);
        $('#editName').val(name);
        $('#editContent').val(content);
        if (image) {
            $('#editImage').val(image);
        }
    });



</script>
 <!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
 
<script>
    $(function () {
        $('#summernote').summernote({
        placeholder: 'Blog Content',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['help']]
        ]
      });
    })

    $(document).ready(function () {
        // Select the file input and the image preview tag
        const fileInput = $('#editImage');
        const imgPreview = $('.img-thumbnail');


        // Listen for file input changes
        fileInput.on('change', function () {
            const file = this.files[0];

            // Check if a file is selected
            if (file) {
                // Validate file type (only images allowed)
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPEG, PNG, GIF).');
                    fileInput.val('');  
                    imgPreview.hide();  
                    return;
                }

                // Display the selected image
                const reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.attr('src', e.target.result);  
                };
                reader.readAsDataURL(file);  
            } else {
                imgPreview.hide();  
            }
        });
    });
</script>
@endpush


@section('title', 'Admin - Blog')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')


      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <b>Edit Blog</b>
            <button class="btn btn-inverse-dark btn-fw btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $blog->id }}" data-name="{{ $blog->name }}">Delete Blog</button>
        </div>
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="mb-3">
                    <label for="editName" class="form-label"><b>Blog Name</b></label>
                    <input type="text" class="form-control" id="editName" name="name" value="{{ old('name', $blog->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="editContent" class="form-label"><b>Content</b></label>
                    <textarea id="summernote" class="form-control" id="editContent" name="content" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="editImage" class="form-label"><b>Image</b></label>
                    <input type="file" class="form-control" id="editImage" name="image">
                </div>
                <hr/>
                <div class="mb-3">
                    <div>
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->name }}" width="100" class="img-thumbnail trigger-lightbox" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('storage/' . $blog->image) }}">
                    </div>
                </div>
                <hr/>
                <table class="table table-bordered mt-2">     
                    <tr>
                        <th>Created At</th>
                        <td>{{ $blog->created_at->format('g:i A -  j M, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $blog->updated_at->format('g:i A -  j M, Y') }}</td>
                    </tr>                             
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.blog.index') }}'">Back</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
    
    
    <!-- Image Lightbox Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Blog Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Blog Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    
     
 
 

<!-- Delete Blog Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the blog: <strong id="deleteCategoryName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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



 