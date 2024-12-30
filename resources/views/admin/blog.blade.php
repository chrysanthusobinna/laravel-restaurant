
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

@endpush


@section('title', 'Admin - Blog')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
 
      @include('partials.message-bag')


        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Blog ({{ $blogs->count() }})</span>
                <button class="btn btn-sm btn-primary" onclick="window.location.href='{{ route('admin.blog.create') }}'">
                    Create New Blog
                </button>                
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="orders-table">
                    <thead>
                        <tr>
                            <th scope="col">Blog Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                        <tr> 
                            <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->name }}" width="100" class="img-thumbnail trigger-lightbox" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('storage/' . $blog->image) }}"> {{ $blog->name }}</td>
                            <td>{{ $blog->updated_at->format('g:i A -  j M, Y') }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm edit-btn"  onclick="window.open('{{ route('blog.view', $blog->id) }}', '_blank')"> <i class="fa fa-eye"></i> </button>
                                <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="window.location.href='{{ route('admin.blog.edit', $blog->id) }}'"> <i class="fa fa-edit"></i> </button>                           
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $blog->id }}" data-name="{{ $blog->name }}"><i class="fa fa-trash"></i></button>
 

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No blog posts available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
        </div>
   
     
 

<!-- Image Lightbox Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Blog Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i></button>
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



 