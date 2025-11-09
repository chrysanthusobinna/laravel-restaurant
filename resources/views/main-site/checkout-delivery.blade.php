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

    /* Cards */
    .choice-grid{ display:grid; gap:12px; }
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
    .option-title{ font-weight:800; margin:0; }
    .option-sub{ color:#6c757d; margin:2px 0 0 0; font-size:.925rem; }
    .checkmark{
        position:absolute; right:12px; top:12px; width:24px; height:24px; border-radius:50%;
        border:2px solid #dee2e6; display:flex; align-items:center; justify-content:center; font-size:14px; color:#fff;
        background:#fff;
    }
    .option-card.active .checkmark{ border-color:#ff3b53; background:#ff3b53; }

    .addr-card { border:1px solid #eef0f3; border-radius:12px; padding:12px 14px; background:#fff; }
    .addr-badge { font-size:.75rem; border:1px solid #eef0f3; border-radius:999px; padding:.15rem .5rem; background:#f8f9fb; }
    .muted { color:#6c757d; }
    </style>

@endpush

@push('scripts')
 
    <!-- Latest jQuery --> 
    <script src="/assets/js/jquery-1.12.4.min.js"></script> 

    <!-- Popper.js (required for Bootstrap 4 modals) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>

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
  // FIX: unlock scroll if a plugin left it locked
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

  // ---- Helpers for option cards ----
  function activateCard(groupSelector, card) {
    document.querySelectorAll(groupSelector+' .option-card').forEach(c=>{
      c.classList.remove('active'); c.setAttribute('aria-pressed','false');
      const cm = c.querySelector('.checkmark'); if (cm) cm.innerHTML='';
    });
    card.classList.add('active'); card.setAttribute('aria-pressed','true');
    const cm = card.querySelector('.checkmark'); if (cm) cm.innerHTML='&#10003;';
  }

  document.addEventListener('DOMContentLoaded', function(){
    // Delivery mode (saved/new)
    const deliveryModeField = document.getElementById('deliveryModeField');
    const hasSaved = document.querySelectorAll('.delivery-saved-item').length > 0;
    const defaultDeliveryMode = deliveryModeField.value || (hasSaved ? 'saved' : 'new');

    const setDeliveryMode = (mode) => {
      deliveryModeField.value = mode;
      activateCard('#deliveryModeGroup', document.querySelector(`#deliveryModeGroup .option-card[data-value="${mode}"]`));
      document.getElementById('delivery_saved_block').classList.toggle('d-none', mode !== 'saved');
      document.getElementById('delivery_new_block').classList.toggle('d-none', mode !== 'new');
    };

    document.querySelectorAll('#deliveryModeGroup .option-card').forEach(card=>{
      card.addEventListener('click', ()=> setDeliveryMode(card.getAttribute('data-value')));
      card.addEventListener('keydown', (e)=>{ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); setDeliveryMode(card.getAttribute('data-value')); }});
    });
    setDeliveryMode(defaultDeliveryMode);

    // Billing same switch
    const billingSame = document.getElementById('billing_same');
    const billingBlock = document.getElementById('billing_block');
    const toggleBilling = () => billingBlock.classList.toggle('d-none', billingSame.checked);
    billingSame.addEventListener('change', toggleBilling);
    toggleBilling();

    // Billing mode (saved/new)
    const billingModeField = document.getElementById('billingModeField');
    const hasSavedBilling = document.querySelectorAll('.billing-saved-item').length > 0;
    const defaultBillingMode = billingModeField.value || (hasSavedBilling ? 'saved' : 'new');

    const setBillingMode = (mode) => {
      billingModeField.value = mode;
      activateCard('#billingModeGroup', document.querySelector(`#billingModeGroup .option-card[data-value="${mode}"]`));
      document.getElementById('billing_saved_block').classList.toggle('d-none', mode !== 'saved');
      document.getElementById('billing_new_block').classList.toggle('d-none', mode !== 'new');
    };

    document.querySelectorAll('#billingModeGroup .option-card').forEach(card=>{
      card.addEventListener('click', ()=> setBillingMode(card.getAttribute('data-value')));
      card.addEventListener('keydown', (e)=>{ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); setBillingMode(card.getAttribute('data-value')); }});
    });
    setBillingMode(defaultBillingMode);

    // Modal trigger fallback (works on Bootstrap 4 or 5)
    document.querySelectorAll('[data-bs-target]').forEach(btn => {
      btn.addEventListener('click', function(e){
        const id = this.getAttribute('data-bs-target');
        const el = document.querySelector(id);
        if (!el) return;
        if (window.bootstrap && window.bootstrap.Modal) {
          new bootstrap.Modal(el).show();
        } else if (window.jQuery && $(el).modal) {
          $(el).modal('show');
        }
      });
    });

    // Autofocus inputs when modal shows
    const focusOnShow = (modalId, inputId) => {
      const el = document.getElementById(modalId);
      if (!el) return;
      el.addEventListener('shown.bs.modal', () => {
        const inp = document.getElementById(inputId);
        inp && inp.focus();
      });
    };
    focusOnShow('deliveryAddressModal', 'del_autocomplete');
    focusOnShow('billingAddressModal', 'bill_autocomplete');

    // Save Delivery modal → hidden fields + preview
    document.getElementById('saveDeliveryModal').addEventListener('click', function(){
      ['line1','line2','city','state','postal','country','formatted','lat','lng'].forEach(k=>{
        document.getElementById('del_'+k).value = document.getElementById('del_m_'+k).value;
      });
      const line = document.getElementById('del_m_line1').value + (document.getElementById('del_m_line2').value ? ', '+document.getElementById('del_m_line2').value : '');
      const meta = document.getElementById('del_m_city').value + ', ' + document.getElementById('del_m_state').value + ' ' + document.getElementById('del_m_postal').value + ', ' + document.getElementById('del_m_country').value;
      document.getElementById('delivery_preview_line').textContent = line;
      document.getElementById('delivery_preview_meta').textContent = meta;
      document.getElementById('delivery_new_preview').classList.remove('d-none');

      // Close (BS5 or BS4)
      const m = document.getElementById('deliveryAddressModal');
      if (window.bootstrap && window.bootstrap.Modal) {
        bootstrap.Modal.getInstance(m)?.hide();
      } else if (window.jQuery && $(m).modal) {
        $(m).modal('hide');
      }
    });

    // Save Billing modal → hidden fields + preview
    document.getElementById('saveBillingModal').addEventListener('click', function(){
      ['line1','line2','city','state','postal','country','formatted','lat','lng'].forEach(k=>{
        document.getElementById('bill_'+k).value = document.getElementById('bill_m_'+k).value;
      });
      const line = document.getElementById('bill_m_line1').value + (document.getElementById('bill_m_line2').value ? ', '+document.getElementById('bill_m_line2').value : '');
      const meta = document.getElementById('bill_m_city').value + ', ' + document.getElementById('bill_m_state').value + ' ' + document.getElementById('bill_m_postal').value + ', ' + document.getElementById('bill_m_country').value;
      document.getElementById('billing_preview_line').textContent = line;
      document.getElementById('billing_preview_meta').textContent = meta;
      document.getElementById('billing_new_preview').classList.remove('d-none');

      const m = document.getElementById('billingAddressModal');
      if (window.bootstrap && window.bootstrap.Modal) {
        bootstrap.Modal.getInstance(m)?.hide();
      } else if (window.jQuery && $(m).modal) {
        $(m).modal('hide');
      }
    });
  });

  // ---- Google Places helpers ----
  function setupAutocomplete(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const ac = new google.maps.places.Autocomplete(input, {
      types: ['geocode'],
      fields: ['address_components', 'geometry', 'formatted_address']
    });
    ac.addListener('place_changed', function () {
      const place = ac.getPlace();
      if (!place || !place.address_components) return;

      const comps = place.address_components;
      const get = type => {
        const c = comps.find(x => x.types.includes(type));
        return c ? c.long_name : '';
      };

      const prefix = inputId.startsWith('del_') ? 'del' : 'bill';
      const streetNumber = get('street_number');
      const route = get('route');
      const line1 = [streetNumber, route].filter(Boolean).join(' ');

      document.getElementById(prefix + '_m_line1').value = line1;
      document.getElementById(prefix + '_m_city').value = get('locality') || get('postal_town') || get('sublocality') || '';
      document.getElementById(prefix + '_m_state').value = get('administrative_area_level_1');
      document.getElementById(prefix + '_m_postal').value = get('postal_code');
      document.getElementById(prefix + '_m_country').value = get('country');
      document.getElementById(prefix + '_m_formatted').value = place.formatted_address;

      if (place.geometry && place.geometry.location) {
        document.getElementById(prefix + '_m_lat').value = place.geometry.location.lat();
        document.getElementById(prefix + '_m_lng').value = place.geometry.location.lng();
      }
    });
  }

  function initCheckoutDeliveryLookups() {
    setupAutocomplete('del_autocomplete');
    setupAutocomplete('bill_autocomplete');
  }
  window.initCheckoutDeliveryLookups = initCheckoutDeliveryLookups;
</script>

{{-- Google Maps (Places) – replace with your key --}}
<script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&libraries=places&callback=initCheckoutDeliveryLookups" async defer></script>

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
<!-- START SECTION SHOP -->
<div class="section">
  <div class="container">
    <form method="POST" action=" {{ route('customer.checkout.delivery.post') }}">
      @csrf
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mx-auto">
          <div class="order_review">
            <h4 class="mb-4">Delivery Address</h4>
            <hr>
            @include('partials.message-bag')

            {{-- ===== Delivery mode selector (Saved vs New) ===== --}}
            @php $hasSaved = isset($addresses) && $addresses->count() > 0; @endphp
            <input type="hidden" name="mode" id="deliveryModeField" value="{{ old('mode', $hasSaved ? 'saved' : 'new') }}">

            <div id="deliveryModeGroup" class="choice-grid mt-2">
              <div class="option-card" data-value="saved" tabindex="0" role="button" aria-pressed="false">
                <div class="checkmark"></div>
                <h6 class="option-title">Use a Saved Address</h6>
                <p class="option-sub">Pick from your address book.</p>
              </div>
              <div class="option-card" data-value="new" tabindex="0" role="button" aria-pressed="false">
                <div class="checkmark"></div>
                <h6 class="option-title">Add a New Address</h6>
                <p class="option-sub">Search and add a new address.</p>
              </div>
            </div>

            {{-- Saved addresses --}}
            <div id="delivery_saved_block" class="mt-3 {{ $hasSaved ? '' : 'd-none' }}">
              @if($hasSaved)
                <div class="list-group mb-3">
                  @foreach($addresses as $addr)
                    <label class="list-group-item d-flex justify-content-between align-items-start delivery-saved-item">
                      <div class="form-check">
                        <input class="form-check-input me-2"
                               type="radio" name="saved_address_id"
                               value="{{ $addr->id }}"
                               {{ old('saved_address_id') == $addr->id ? 'checked' : '' }}>
                        <div>
                          <div class="fw-semibold">
                            {{ $addr->street ?? '' }}{{ $addr->street && $addr->city ? ', ' : '' }}{{ $addr->city ?? '' }} {{ $addr->postal_code ?? '' }}
                          </div>
                          <small class="muted">
                            {{ $addr->state ?? '' }}{{ ($addr->state && $addr->country) ? ', ' : '' }}{{ $addr->country ?? '' }}
                            @if(!empty($addr->label)) <span class="addr-badge ms-2">{{ ucfirst($addr->label) }}</span> @endif
                          </small>
                        </div>
                      </div>
                      <div class="d-flex gap-2">
                        <a href="" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="" class="btn btn-sm btn-outline-danger">Delete</a>
                      </div>
                    </label>
                  @endforeach
                </div>
              @else
                <div class="alert alert-info">You have no saved addresses yet.</div>
              @endif

              <button type="button"
                      class="btn btn-outline-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#deliveryAddressModal">
                Search & Add New Address
              </button>
            </div>

            {{-- New delivery address (via modal; shows preview) --}}
            <div id="delivery_new_block" class="mt-3 {{ $hasSaved ? 'd-none' : '' }}">
              <button type="button"
                      class="btn btn-outline-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#deliveryAddressModal">
                Search & Add New Address
              </button>

              <div id="delivery_new_preview" class="addr-card mt-3 d-none">
                <div class="fw-semibold" id="delivery_preview_line"></div>
                <small class="muted" id="delivery_preview_meta"></small>
              </div>

              {{-- Hidden fields for new delivery address --}}
              <input type="hidden" name="new[line1]" id="del_line1" value="{{ old('new.line1') }}">
              <input type="hidden" name="new[line2]" id="del_line2" value="{{ old('new.line2') }}">
              <input type="hidden" name="new[city]" id="del_city" value="{{ old('new.city') }}">
              <input type="hidden" name="new[state]" id="del_state" value="{{ old('new.state') }}">
              <input type="hidden" name="new[postal_code]" id="del_postal" value="{{ old('new.postal_code') }}">
              <input type="hidden" name="new[country]" id="del_country" value="{{ old('new.country') }}">
              <input type="hidden" name="new[formatted_address]" id="del_formatted" value="{{ old('new.formatted_address') }}">
              <input type="hidden" name="new[lat]" id="del_lat" value="{{ old('new.lat') }}">
              <input type="hidden" name="new[lng]" id="del_lng" value="{{ old('new.lng') }}">
            </div>

            {{-- Billing same as delivery --}}
            <div class="form-check form-switch mt-4">
              <input class="form-check-input" type="checkbox" id="billing_same" name="billing_same" value="1" {{ old('billing_same', 1) ? 'checked' : '' }}>
              <label class="form-check-label" for="billing_same">Billing address is the same as delivery</label>
            </div>

            {{-- ===== Billing block (revealed if unchecked) ===== --}}
            <div id="billing_block" class="mt-3 d-none">
              <h4 class="mb-3">Billing Address</h4>

              <input type="hidden" name="billing[mode]" id="billingModeField" value="{{ old('billing.mode', $hasSaved ? 'saved' : 'new') }}">

              <div id="billingModeGroup" class="choice-grid">
                <div class="option-card" data-value="saved" tabindex="0" role="button" aria-pressed="false">
                  <div class="checkmark"></div>
                  <h6 class="option-title">Use a Saved Address</h6>
                  <p class="option-sub">Pick from your address book.</p>
                </div>
                <div class="option-card" data-value="new" tabindex="0" role="button" aria-pressed="false">
                  <div class="checkmark"></div>
                  <h6 class="option-title">Add a New Address</h6>
                  <p class="option-sub">Search and add a new address.</p>
                </div>
              </div>

              <div id="billing_saved_block" class="mt-3 {{ $hasSaved ? '' : 'd-none' }}">
                @if($hasSaved)
                  <div class="list-group mb-3">
                    @foreach($addresses as $addr)
                      <label class="list-group-item d-flex justify-content-between align-items-start billing-saved-item">
                        <div class="form-check">
                          <input class="form-check-input me-2"
                                 type="radio" name="billing[saved_address_id]"
                                 value="{{ $addr->id }}"
                                 {{ old('billing.saved_address_id') == $addr->id ? 'checked' : '' }}>
                          <div>
                            <div class="fw-semibold">
                              {{ $addr->street ?? '' }}{{ $addr->street && $addr->city ? ', ' : '' }}{{ $addr->city ?? '' }} {{ $addr->postal_code ?? '' }}
                            </div>
                            <small class="muted">
                              {{ $addr->state ?? '' }}{{ ($addr->state && $addr->country) ? ', ' : '' }}{{ $addr->country ?? '' }}
                              @if(!empty($addr->label)) <span class="addr-badge ms-2">{{ ucfirst($addr->label) }}</span> @endif
                            </small>
                          </div>
                        </div>
                        <div class="d-flex gap-2">
                          <a href="" class="btn btn-sm btn-outline-secondary">Edit</a>
                          <a href="" class="btn btn-sm btn-outline-danger">Delete</a>
                        </div>
                      </label>
                    @endforeach
                  </div>
                @else
                  <div class="alert alert-info">You have no saved addresses yet.</div>
                @endif

                <button type="button"
                        class="btn btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#billingAddressModal">
                  Search & Add New Address
                </button>
              </div>

              <div id="billing_new_block" class="mt-3 {{ $hasSaved ? 'd-none' : '' }}">
                <button type="button"
                        class="btn btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#billingAddressModal">
                  Search & Add New Address
                </button>

                <div id="billing_new_preview" class="addr-card mt-3 d-none">
                  <div class="fw-semibold" id="billing_preview_line"></div>
                  <small class="muted" id="billing_preview_meta"></small>
                </div>

                {{-- Hidden fields for new billing address --}}
                <input type="hidden" name="billing[new][line1]" id="bill_line1" value="{{ old('billing.new.line1') }}">
                <input type="hidden" name="billing[new][line2]" id="bill_line2" value="{{ old('billing.new.line2') }}">
                <input type="hidden" name="billing[new][city]" id="bill_city" value="{{ old('billing.new.city') }}">
                <input type="hidden" name="billing[new][state]" id="bill_state" value="{{ old('billing.new.state') }}">
                <input type="hidden" name="billing[new][postal_code]" id="bill_postal" value="{{ old('billing.new.postal_code') }}">
                <input type="hidden" name="billing[new][country]" id="bill_country" value="{{ old('billing.new.country') }}">
                <input type="hidden" name="billing[new][formatted_address]" id="bill_formatted" value="{{ old('billing.new.formatted_address') }}">
                <input type="hidden" name="billing[new][lat]" id="bill_lat" value="{{ old('billing.new.lat') }}">
                <input type="hidden" name="billing[new][lng]" id="bill_lng" value="{{ old('billing.new.lng') }}">
              </div>
            </div>

            {{-- Buttons --}}
            <div class="form-group col-md-12 mt-4 p-0">
              <button type="submit" class="btn btn-default btn-block">Continue</button>
            </div>
            <div class="form-group col-md-12 p-0">
              <a href="{{ route('customer.checkout.fulfilment') }}" class="btn btn-default btn-block">Back</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- END SECTION SHOP -->

{{-- ===== Delivery Modal ===== --}}
<div class="modal fade" id="deliveryAddressModal" tabindex="-1" aria-labelledby="deliveryAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="deliveryAddressModalLabel">Search & Add Delivery Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label class="form-label">Search address</label>
        <input type="text" id="del_autocomplete" class="form-control mb-3" placeholder="Start typing address...">

        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Street</label>
            <input id="del_m_line1" class="form-control" value="">
          </div>
          <div class="col-md-4">
            <label class="form-label">Apt / Suite</label>
            <input id="del_m_line2" class="form-control" value="">
          </div>
          <div class="col-md-5">
            <label class="form-label">City</label>
            <input id="del_m_city" class="form-control" value="">
          </div>
          <div class="col-md-3">
            <label class="form-label">State / Province</label>
            <input id="del_m_state" class="form-control" value="">
          </div>
          <div class="col-md-4">
            <label class="form-label">Postal Code</label>
            <input id="del_m_postal" class="form-control" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label">Country</label>
            <input id="del_m_country" class="form-control" value="">
          </div>
          <input type="hidden" id="del_m_formatted">
          <input type="hidden" id="del_m_lat">
          <input type="hidden" id="del_m_lng">
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="saveDeliveryModal" class="btn btn-primary">Use this address</button>
      </div>
    </div>
  </div>
</div>

{{-- ===== Billing Modal ===== --}}
<div class="modal fade" id="billingAddressModal" tabindex="-1" aria-labelledby="billingAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="billingAddressModalLabel">Search & Add Billing Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label class="form-label">Search address</label>
        <input type="text" id="bill_autocomplete" class="form-control mb-3" placeholder="Start typing address...">

        <div class="row g-3">
          <div class="col-md-8">
            <label class="form-label">Street</label>
            <input id="bill_m_line1" class="form-control" value="">
          </div>
          <div class="col-md-4">
            <label class="form-label">Apt / Suite</label>
            <input id="bill_m_line2" class="form-control" value="">
          </div>
          <div class="col-md-5">
            <label class="form-label">City</label>
            <input id="bill_m_city" class="form-control" value="">
          </div>
          <div class="col-md-3">
            <label class="form-label">State / Province</label>
            <input id="bill_m_state" class="form-control" value="">
          </div>
          <div class="col-md-4">
            <label class="form-label">Postal Code</label>
            <input id="bill_m_postal" class="form-control" value="">
          </div>
          <div class="col-md-6">
            <label class="form-label">Country</label>
            <input id="bill_m_country" class="form-control" value="">
          </div>
          <input type="hidden" id="bill_m_formatted">
          <input type="hidden" id="bill_m_lat">
          <input type="hidden" id="bill_m_lng">
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="saveBillingModal" class="btn btn-primary">Use this address</button>
      </div>
    </div>
  </div>
</div>
@endsection
