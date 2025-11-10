@extends('layouts.main-site')

@push('styles')
    <!-- Animation CSS -->
    <link rel="stylesheet" href="/assets/css/animate.css">
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
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
      .fieldset { border:1px dashed #e9ecef; border-radius:12px; padding:14px; background:#fff; }
      .fieldset legend { font-size:.95rem; font-weight:700; padding:0 6px; width:auto; }
    </style>
@endpush

@push('scripts')
    <!-- jQuery -->
    <script src="/assets/js/jquery-1.12.4.min.js"></script>
    <!-- Bootstrap -->
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Your other vendor scripts (unchanged) -->
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

    <script>
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

        // Toggle inline new-address fieldsets (no modals)
        document.querySelectorAll('[data-toggle-inline]').forEach(btn=>{
          btn.addEventListener('click', function(){
            const target = document.querySelector(this.getAttribute('data-toggle-inline'));
            if (!target) return;
            target.classList.toggle('d-none');

            // Focus the search input if present
            const si = target.querySelector('input[data-places-search]');
            if (si) setTimeout(()=> si.focus(), 10);
          });
        });
      });

      // ---- Google Places helpers ----
      function setupAutocomplete(inputId, mappingPrefix) {
        const input = document.getElementById(inputId);
        if (!input) return;

        // Prevent Enter from submitting the page while typing address
        input.addEventListener('keydown', function(e){ if (e.key === 'Enter') e.preventDefault(); });

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

          const streetNumber = get('street_number');
          const route = get('route');
          const line1 = [streetNumber, route].filter(Boolean).join(' ');

          document.getElementById(mappingPrefix + '_line1').value = line1;
          // line2 left for Apt/Suite manual entry
          document.getElementById(mappingPrefix + '_city').value   = get('locality') || get('postal_town') || get('sublocality') || '';
          document.getElementById(mappingPrefix + '_state').value  = get('administrative_area_level_1');
          document.getElementById(mappingPrefix + '_postal').value = get('postal_code');
          document.getElementById(mappingPrefix + '_country').value= get('country');
        });
      }

      // Safe guard to avoid inputs being forced disabled by other scripts
      function protectPlacesInput(id){
        const el = document.getElementById(id);
        if (!el) return;
        function unlockOnce(){
          if (el.disabled) el.disabled = false;
          if (el.readOnly) el.readOnly = false;
          if (el.classList.contains('disabled')) el.classList.remove('disabled');
          if (el.hasAttribute('aria-disabled')) el.removeAttribute('aria-disabled');
        }
        let debounceTimer=null;
        const obs = new MutationObserver(muts=>{
          let needs=false;
          for(const m of muts){
            if(['disabled','readonly','aria-disabled','class'].includes(m.attributeName)){
              if (el.disabled || el.readOnly || el.classList.contains('disabled') || el.hasAttribute('aria-disabled')) { needs = true; break; }
            }
          }
          if(!needs) return;
          obs.disconnect(); unlockOnce();
          clearTimeout(debounceTimer); debounceTimer=setTimeout(()=>obs.observe(el,{attributes:true,attributeFilter:['disabled','readonly','class','aria-disabled']}),120);
        });
        obs.observe(el,{attributes:true,attributeFilter:['disabled','readonly','class','aria-disabled']});
        ['focus','input','click'].forEach(evt=> el.addEventListener(evt, ()=>{ if(unlockOnce()){ obs.disconnect(); clearTimeout(debounceTimer); debounceTimer=setTimeout(()=>obs.observe(el,{attributes:true,attributeFilter:['disabled','readonly','class','aria-disabled']}),120);} }, true));
      }

      function initCheckoutDeliveryLookups() {
        // delivery new
        setupAutocomplete('del_autocomplete', 'del');
        protectPlacesInput('del_autocomplete');

        // billing new
        setupAutocomplete('bill_autocomplete', 'bill');
        protectPlacesInput('bill_autocomplete');
      }
      window.initCheckoutDeliveryLookups = initCheckoutDeliveryLookups;
    </script>

    {{-- Google Maps (Places) – replace with your key --}}
    <script src="https://maps.googleapis.com/maps/api/js?key={{  config('services.google_maps.api_key') }}&libraries=places&callback=initCheckoutDeliveryLookups" async defer></script>
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
    <form method="POST" action="{{ route('customer.checkout.delivery.post') }}">
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

            {{-- ===== Saved addresses ===== --}}
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
                         <a href="#" class="btn btn-sm btn-outline-danger"> <i class="fas fa-times"></i></a>
                       </div>
                    </label>
                  @endforeach
                </div>
              @else
                <div class="alert alert-info">You have no saved addresses yet.</div>
              @endif

  
            </div>

            {{-- ===== New delivery address (inline) ===== --}}
            <div id="delivery_new_block" class="mt-3 {{ $hasSaved ? 'd-none' : '' }}">
              <div id="delivery_new_inline" class="fieldset">
                <legend>New Delivery Address</legend>

                <label class="form-label">Search address</label>
                <input type="text"
                       id="del_autocomplete"
                       class="form-control mb-3"
                       placeholder="Start typing address..."
                       data-places-search
                       autocomplete="off" spellcheck="false">

                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label">Street</label>
                        <input id="del_line1" name="new[line1]" class="form-control" value="{{ old('new.line1') }}">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Apt / Suite</label>
                        <input id="del_line2" name="new[line2]" class="form-control" value="{{ old('new.line2') }}">
                      </div>

                      <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input id="del_city" name="new[city]" class="form-control" value="{{ old('new.city') }}">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">State / Province</label>
                        <input id="del_state" name="new[state]" class="form-control" value="{{ old('new.state') }}">
                      </div>

                      <div class="col-md-6">
                        <label class="form-label">Postal Code</label>
                        <input id="del_postal" name="new[postal_code]" class="form-control" value="{{ old('new.postal_code') }}">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input id="del_country" name="new[country]" class="form-control" value="{{ old('new.country') }}">
                      </div>
                    </div>

              </div>
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
                          <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></a>
                        </div>
                      </label>
                    @endforeach
                  </div>
                @else
                  <div class="alert alert-info">You have no saved addresses yet.</div>
                @endif
 
              </div>

              <div id="billing_new_block" class="mt-3 {{ $hasSaved ? 'd-none' : '' }}">
                <div id="billing_new_inline" class="fieldset">
                  <legend>New Billing Address</legend>

                  <label class="form-label">Search address</label>
                  <input type="text"
                         id="bill_autocomplete"
                         class="form-control mb-3"
                         placeholder="Start typing address..."
                         data-places-search
                         autocomplete="off" spellcheck="false">

                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Street</label>
                            <input id="bill_line1" name="billing[new][line1]" class="form-control" value="{{ old('billing.new.line1') }}">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Apt / Suite</label>
                            <input id="bill_line2" name="billing[new][line2]" class="form-control" value="{{ old('billing.new.line2') }}">
                          </div>

                          <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input id="bill_city" name="billing[new][city]" class="form-control" value="{{ old('billing.new.city') }}">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">State / Province</label>
                            <input id="bill_state" name="billing[new][state]" class="form-control" value="{{ old('billing.new.state') }}">
                          </div>

                          <div class="col-md-6">
                            <label class="form-label">Postal Code</label>
                            <input id="bill_postal" name="billing[new][postal_code]" class="form-control" value="{{ old('billing.new.postal_code') }}">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <input id="bill_country" name="billing[new][country]" class="form-control" value="{{ old('billing.new.country') }}">
                          </div>
                        </div>

                </div>
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
@endsection
