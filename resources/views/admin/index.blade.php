
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('salesBarChart').getContext('2d');
        var salesData = {!! json_encode(array_values($salesData)) !!}; // Sales values
        var salesLabels = {!! json_encode(array_keys($salesData)) !!}; // Month names

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: salesLabels, // Months
                datasets: [{
                    label: 'Monthly Sales (USD)',
                    data: salesData, // Sales data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endpush


@section('title', 'Admin - Dashboard')




@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      @include('partials.message-bag')

      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0 font-weight-bold">Kenneth Osborne</h3>
          <p>Your last login: 21h ago from newzealand.</p>
        </div>
        <div class="col-sm-6">
          <div class="d-flex align-items-center justify-content-md-end">
            <div class="mb-3 mb-xl-0 pr-1">
                <div class="dropdown">
                  <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border mr-2" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="typcn typcn-calendar-outline mr-2"></i>Last 7 days
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" data-x-placement="top-start">
                    <h6 class="dropdown-header">Last 14 days</h6>
                    <a class="dropdown-item" href="#">Last 21 days</a>
                    <a class="dropdown-item" href="#">Last 28 days</a>
                  </div>
                </div>
            </div>
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
              <button type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-arrow-forward-outline mr-2"></i>Export</button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
              <button type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-info-large-outline mr-2"></i>info</button>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-lg-12 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Sales Bar Chart ({{ date('Y') }})</h4>
              </div>
              <hr/>

              <canvas id="salesBarChart"></canvas>

          

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Quick Links</h4>
              </div>
              <hr/>



              <button type="button" class="mt-2 btn btn-secondary btn-block btn-icon-text d-flex align-items-center justify-content-start text-start">
                  <i class="typcn typcn-document-add btn-icon-prepend me-2"></i> <b>NEW SALES RECORD</b>
              </button>
              
              <button type="button" class="mt-2 btn btn-secondary btn-block btn-icon-text d-flex align-items-center justify-content-start text-start">
                  <i class="typcn typcn-document-text btn-icon-prepend me-2"></i> <b>VIEW ALL SALES RECORD</b>
              </button>


              <button type="button" class="mt-2 btn btn-secondary btn-block btn-icon-text d-flex align-items-center justify-content-start text-start">
                  <i class="typcn typcn-edit btn-icon-prepend me-2"></i> <b>ADD BLOG POST</b>
              </button>

              <button type="button" class="mt-2 btn btn-secondary btn-block btn-icon-text d-flex align-items-center justify-content-start text-start">
                  <i class="typcn typcn-tabs-outline btn-icon-prepend me-2"></i> <b>VIEW ALL BLOG POSTS</b>
              </button>
              


             </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between">
                <h4 class="card-title mb-3">Recent Sales</h4>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex">
                          <img class="img-sm rounded-circle mb-md-0 mr-2" src="/admin_resources/images/faces/face30.png" alt="profile image">
                          <div>
                            <div> Company</div>
                            <div class="font-weight-bold mt-1">volkswagen</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        Budget
                        <div class="font-weight-bold  mt-1">$2322 </div>
                      </td>
                      <td>
                        Status
                        <div class="font-weight-bold text-success  mt-1">88% </div>
                      </td>
                      <td>
                        Deadline
                        <div class="font-weight-bold  mt-1">07 Nov 2019</div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex">
                          <img class="img-sm rounded-circle mb-md-0 mr-2" src="/admin_resources/images/faces/face31.png" alt="profile image">
                          <div>
                            <div> Company</div>
                            <div class="font-weight-bold  mt-1">Land Rover</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        Budget
                        <div class="font-weight-bold  mt-1">$12022  </div>
                      </td>
                      <td>
                        Status
                        <div class="font-weight-bold text-success  mt-1">70% </div>
                      </td>
                      <td>
                        Deadline
                        <div class="font-weight-bold  mt-1">08 Nov 2019</div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex">
                          <img class="img-sm rounded-circle mb-md-0 mr-2" src="/admin_resources/images/faces/face32.png" alt="profile image">
                          <div>
                            <div> Company</div>
                            <div class="font-weight-bold  mt-1">Bentley </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        Budget
                        <div class="font-weight-bold  mt-1">$8,725</div>
                      </td>
                      <td>
                        Status
                        <div class="font-weight-bold text-success  mt-1">87% </div>
                      </td>
                      <td>
                        Deadline
                        <div class="font-weight-bold  mt-1">11 Jun 2019</div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex">
                          <img class="img-sm rounded-circle mb-md-0 mr-2" src="/admin_resources/images/faces/face33.png" alt="profile image">
                          <div>
                            <div> Company</div>
                            <div class="font-weight-bold  mt-1">Morgan </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        Budget
                        <div class="font-weight-bold  mt-1">$5,220 </div>
                      </td>
                      <td>
                        Status
                        <div class="font-weight-bold text-success  mt-1">65% </div>
                      </td>
                      <td>
                        Deadline
                        <div class="font-weight-bold  mt-1">26 Oct 2019</div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex">
                          <img class="img-sm rounded-circle mb-md-0 mr-2" src="/admin_resources/images/faces/face34.png" alt="profile image">
                          <div>
                            <div> Company</div>
                            <div class="font-weight-bold  mt-1">volkswagen</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        Budget
                        <div class="font-weight-bold  mt-1">$2322 </div>
                      </td>
                      <td>
                        Status
                        <div class="font-weight-bold text-success mt-1">88% </div>
                      </td>
                      <td>
                        Deadline
                        <div class="font-weight-bold  mt-1">07 Nov 2019</div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-secondary">edit actions</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
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



 