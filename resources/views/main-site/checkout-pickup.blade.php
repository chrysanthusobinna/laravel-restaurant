
@extends('layouts.main-site')

@push('styles')
    
    
    <!-- Animation CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">	
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet"> 
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <!--- owl carousel CSS-->
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <!-- DatePicker CSS -->
    <link href="/assets/css/datepicker.min.css" rel="stylesheet">
    <!-- TimePicker CSS -->
    <link href="/assets/css/mdtimepicker.min.css" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="/assets/color/theme-red.css">

<style>
  /* Ensure page can scroll even if something left it locked */
  html, body { overflow-y: auto !important; height: auto !important; }
  .modal-backdrop, .offcanvas-backdrop { display: none !important; }

  /* Account for fixed header */
  .section { padding-top: 30px; padding-bottom: 40px; }

  /* Cards grid */
  .choice-grid { display: grid; gap: 12px; }

  .option-card{
    border:1px solid #e9ecef; border-radius:12px; padding:14px 16px; cursor:pointer;
    transition:transform .15s ease, box-shadow .15s ease, border-color .15s ease, background .15s ease;
    background:#fff; position:relative;
  }
  .option-card:hover{ transform:translateY(-1px); box-shadow:0 10px 24px rgba(0,0,0,.06) }
  .option-card.active{
    border-color:#ff3b53; background:linear-gradient(0deg, rgba(255,59,83,.07), rgba(255,59,83,.07)), #fff;
    box-shadow:0 10px 26px rgba(255,59,83,.12);
  }
  .option-title{font-weight:800; margin:0}
  .option-sub{color:#6c757d; margin:2px 0 0 0; font-size:.925rem}
  .checkmark{
    position:absolute; right:12px; top:12px; width:24px; height:24px; border-radius:50%;
    border:2px solid #dee2e6; display:flex; align-items:center; justify-content:center; font-size:14px; color:#fff;
    background:#fff;
  }
  .option-card.active .checkmark{ border-color:#ff3b53; background:#ff3b53 }
  .focus-ring:focus{ outline:3px solid rgba(13,110,253,.35); outline-offset:2px; }

  /* Hide any legacy radios if present */
  .sr-only-radio { position:absolute; left:-9999px; }
</style>
@endpush

@push('scripts')
 
    <!-- Latest jQuery --> 
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 
    <!-- Latest compiled and minified Bootstrap --> 
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
    <!-- owl-carousel min js  --> 
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <!-- magnific-popup min js  --> 
    <script src="/assets/js/magnific-popup.min.js"></script> 
    <!-- waypoints min js  --> 
    <script src="/assets/js/waypoints.min.js"></script> 
    <!-- parallax js  --> 
    <script src="/assets/js/parallax.js"></script> 
    <!-- countdown js  --> 
    <script src="/assets/js/jquery.countdown.min.js"></script> 
    <!-- jquery.countTo js  -->
    <script src="/assets/js/jquery.countTo.js"></script>
    <!-- imagesloaded js --> 
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- isotope min js --> 
    <script src="/assets/js/isotope.min.js"></script>
    <!-- jquery.appear js  -->
    <script src="/assets/js/jquery.appear.js"></script>
    <!-- jquery.dd.min js -->
    <script src="/assets/js/jquery.dd.min.js"></script>
    <!-- slick js -->
    <script src="/assets/js/slick.min.js"></script>
    <!-- DatePicker js -->
    <script src="/assets/js/datepicker.min.js"></script>
    <!-- TimePicker js -->
    <script src="/assets/js/mdtimepicker.min.js"></script>
    <!-- scripts js --> 
    <script src="/assets/js/scripts.js"></script>

 <script>
  (function () {
    // Safety: unlock scrolling if some component left it locked
    const unlock = () => {
      document.documentElement.style.overflowY = 'auto';
      document.body.style.overflowY = 'auto';
      document.body.classList.remove('modal-open','offcanvas-open','overflow-hidden');
      document.querySelectorAll('.modal-backdrop, .offcanvas-backdrop')
        .forEach(el => el.parentNode && el.parentNode.removeChild(el));
    };
    document.addEventListener('DOMContentLoaded', unlock);
    window.addEventListener('load', unlock);

    // Card interactions
    function activateCard(card){
      document.querySelectorAll('.option-card').forEach(c=>{
        c.classList.remove('active');
        c.setAttribute('aria-pressed','false');
        const cm = c.querySelector('.checkmark'); if (cm) cm.innerHTML='';
      });
      card.classList.add('active');
      card.setAttribute('aria-pressed','true');
      const cm = card.querySelector('.checkmark'); if (cm) cm.innerHTML='&#10003;';
      document.getElementById('pickupField').value = card.getAttribute('data-id');
    }

    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.option-card');
      const hidden = document.getElementById('pickupField');
      if (!cards.length) return;

      // Preselect from hidden value (old input) or default to first card
      let pre = hidden.value;
      let match = pre && Array.from(cards).find(c => c.getAttribute('data-id') === pre);
      activateCard(match || cards[0]);

      cards.forEach(card=>{
        card.addEventListener('click', ()=> activateCard(card));
        card.addEventListener('keydown', (e)=>{
          if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); activateCard(card); }
        });
      });

      // Ensure something is selected before submit
      const form = document.getElementById('pickupForm');
      form.addEventListener('submit', function(e){
        if (!hidden.value) {
          e.preventDefault();
          if (cards[0]) activateCard(cards[0]);
        }
      });
    });
  })();
</script>

@endpush


@section('title', 'Create Account')


@section('header')
    <!-- START HEADER -->
        <header class="header_wrap fixed-top header_with_topbar light_skin main_menu_uppercase">
        <div class="container">
            @include('partials.nav')
        </div>
    </header>
    <!-- END HEADER -->
@endsection


@section('content')
<div class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-6 mx-auto">
        <div class="order_review">
          <h4 class="mb-4">Select Pickup Location</h4>
          <hr>

          @include('partials.message-bag')

          @if($pickupLocations->isEmpty())
            <p class="text-muted">No pickup locations are currently available.</p>
          @else
            <form id="pickupForm" method="POST" action="{{ route('customer.checkout.pickup.post') }}">
              @csrf

              {{-- Hidden field that actually posts the selection --}}
              <input type="hidden" name="pickup_location_id" id="pickupField" value="{{ old('pickup_location_id') }}">

              <div class="choice-grid">
                @foreach($pickupLocations as $location)
                  <div class="option-card focus-ring"
                       data-id="{{ $location->id }}"
                       tabindex="0" role="button" aria-pressed="false">
                    <div class="checkmark"></div>
                    <h6 class="option-title">Pickup Point</h6>
                    <p class="option-sub mb-0">{{ $location->full_address }}</p>
                  </div>
                @endforeach
              </div>

              <div class="form-group mt-4">
                <button type="submit" class="btn btn-default btn-block">Continue to Payment</button>
              </div>
              <div class="form-group">
                <a href="{{ route('customer.checkout.fulfilment') }}" class="btn btn-default btn-block">Back</a>
              </div>
            </form>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection