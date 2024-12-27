
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
        placeholder: 'Privacy Policy',
        tabsize: 2,
        height: 500,
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

</script>

@endpush


@section('title', 'Admin - Privacy Policy ')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')


      <div class="card">
        <div class="card-header">
            <b>Privacy Policy </b>
        </div>
        <form action="{{ route('admin.privacy-policy.update') }}" method="POST" >
            @csrf
            <div class="card-body">
  
                <div class="mb-3">
                    <label for="editContent" class="form-label"><b>Content</b></label>
                    <textarea  id="summernote" name="content" class="form-control" rows="10" required>{{ old('content', $privacyPolicy->content ?? '') }}</textarea>
                </div>
                 
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="history.go(-1)">Back</button>
                <button type="Save" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
    
    
 
 
  




   
    </div>
    <!-- content-wrapper ends -->
    @include('partials.admin.footer')

  </div>
  <!-- main-panel ends -->
@endsection



 