<!-- Display success message -->
@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

<!-- Display custom error message -->
@if (session('error'))
    <x-alert type="danger" :message="session('error')" />
@endif

<!-- Display validation errors -->
@if ($errors->any())
    <x-alert type="danger" :message="$errors->first()" />
@endif
