@extends('layouts.main-site')

@push('styles')
    <!-- theme/vendor css (as you had) -->
    <link rel="stylesheet" href="/assets/css/animate.css">	
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/linearicons.css">
    <link rel="stylesheet" href="/assets/css/flaticon.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
    <link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="/assets/css/slick-theme.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link href="/assets/css/datepicker.min.css" rel="stylesheet">
    <link href="/assets/css/mdtimepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link id="layoutstyle" rel="stylesheet" href="/assets/color/theme-red.css">

    <!-- Page styles -->
    <style>
      /* --- FIX: ensure page can scroll even if a plugin left it locked --- */
      html, body { overflow-y: auto !important; height: auto !important; }
      .modal-backdrop, .offcanvas-backdrop { display: none !important; }

      /* account for fixed header so content isn't clipped */
      .section { padding-top: 30px; padding-bottom: 40px; }

      /* choice cards */
      .choice-grid{display:grid;gap:12px}
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
    </style>
@endpush

@push('scripts')
    <!-- vendor js (as you had) -->
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
    <script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
    <script src="/assets/js/magnific-popup.min.js"></script> 
    <script src="/assets/js/waypoints.min.js"></script> 
    <script src="/assets/js/parallax.js"></script> 
    <script src="/assets/js/jquery.countdown.min.js"></script> 
    <script src="/assets/js/jquery.countTo.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/isotope.min.js"></script>
    <script src="/assets/js/jquery.appear.js"></script>
    <script src="/assets/js/jquery.dd.min.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/datepicker.min.js"></script>
    <script src="/assets/js/mdtimepicker.min.js"></script>
    <script src="/assets/js/scripts.js"></script>

    <!-- FIX: unlock scroll if any plugin left the page in a locked state -->
    <script>
      (function () {
        const unlock = () => {
          document.documentElement.style.overflowY = 'auto';
          document.body.style.overflowY = 'auto';
          document.body.classList.remove('modal-open','offcanvas-open','overflow-hidden');
          document.querySelectorAll('.modal-backdrop, .offcanvas-backdrop')
            .forEach(el => el.parentNode && el.parentNode.removeChild(el));
        };
        document.addEventListener('DOMContentLoaded', unlock);
        window.addEventListener('load', unlock);
      })();
    </script>

    <!-- Card interaction -->
    <script>
      (function() {
        function activateCard(card){
          document.querySelectorAll('.option-card').forEach(c=>{
            c.classList.remove('active');
            c.setAttribute('aria-pressed','false');
            const cm = c.querySelector('.checkmark'); if(cm) cm.innerHTML='';
          });
          card.classList.add('active');
          card.setAttribute('aria-pressed','true');
          const cm = card.querySelector('.checkmark'); if(cm) cm.innerHTML='&#10003;';
          document.getElementById('methodField').value = card.getAttribute('data-value');
        }
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.option-card').forEach(card=>{
            card.addEventListener('click', ()=> activateCard(card));
            card.addEventListener('keydown', (e)=>{
              if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); activateCard(card); }
            });
          });
        });
      })();
    </script>
@endpush

@section('title', 'Choose Delivery Method')

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
<!-- START SECTION SHOP -->
<div class="section">
  <div class="container">

    <form method="POST" action="{{ route('customer.checkout.fulfilment.post') }}">
      @csrf
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mx-auto">
          <div class="order_review">
            <h4 class="mb-4">Choose Delivery Method</h4>
            <hr>
            @include('partials.message-bag')

            @php
              $selected = old('method', 'pickup');
            @endphp

            <input type="hidden" name="method" id="methodField" value="{{ $selected }}">

            <div class="choice-grid mt-2">
              <div class="option-card focus-ring {{ $selected === 'pickup' ? 'active' : '' }}"
                   data-value="pickup" tabindex="0" role="button" aria-pressed="{{ $selected === 'pickup' ? 'true' : 'false' }}">
                <div class="checkmark">{!! $selected === 'pickup' ? '&#10003;' : '' !!}</div>
                <h6 class="option-title">Pick Up from Store</h6>
                <p class="option-sub">Collect your order at any of our available pickup locations.</p>
              </div>

              <div class="option-card focus-ring {{ $selected === 'delivery' ? 'active' : '' }}"
                   data-value="delivery" tabindex="0" role="button" aria-pressed="{{ $selected === 'delivery' ? 'true' : 'false' }}">
                <div class="checkmark">{!! $selected === 'delivery' ? '&#10003;' : '' !!}</div>
                <h6 class="option-title">Deliver to My Address</h6>
                <p class="option-sub">Have your order delivered to your saved or new address.</p>
              </div>
            </div>

            <div class="form-group col-md-12 mt-4 p-0">
              <button type="submit" class="btn btn-default btn-block">Continue</button>
            </div>
            <div class="form-group col-md-12 p-0">
              <a href="{{ route('customer.checkout.details') }}" class="btn btn-default btn-block">Back</a>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</div>
<!-- END SECTION SHOP -->
@endsection
