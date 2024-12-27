
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

        // Initially hide the image preview
        imgPreview.hide();

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
                    imgPreview.attr('src', e.target.result).show();  
                };
                reader.readAsDataURL(file);  
            } else {
                imgPreview.hide();  
            }
        });
    });
</script>

@endpush


@section('title', 'Admin - Create Blog')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')


      <div class="card">
        <div class="card-header">
            <b>Create Blog Post</b>
        </div>
        <form action="{{ route('admin.blog.store') }}" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="editName" class="form-label"><b>Blog Name</b></label>
                    <input type="text" class="form-control" id="editName" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="editContent" class="form-label"><b>Content</b></label>
                    <textarea id="summernote" class="form-control" id="editContent" name="content" rows="5" required>{{ old('content') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="editImage" class="form-label"><b>Image</b></label>
                    <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
                </div>
                <hr/>
                <div class="mb-3">
                    <div>
                        <img src=" " style="display: none;" alt="blog img"  width="100" class="img-thumbnail" >
                    </div>
                </div>
                 
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.blog.index') }}'">Back</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
    
    
 
 
  




   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')

  </div>
  <!-- main-panel ends -->
@endsection



 