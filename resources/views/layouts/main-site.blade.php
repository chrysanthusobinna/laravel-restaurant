<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="{{ config('site.name') }}" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Best restaurant experience, don't miss out on {{ config('site.name') }}.">
<meta name="keywords" content="African food, Fast Food, cafe, bar, BBQ, restaurant, sushi, steakhouse, pizza, Mexican Food, menu, meat, Breakfast, Lunch, Dinner, Delicious, Tasty, Snack, Wine, Cola">

<!-- SITE TITLE -->
<title>@yield('title')</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="/favicon_io/favicon.ico" />

@stack('styles')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body>

<!-- LOADER -->
<div id="preloader">
	<div class="loader_wrap">
        <div class="sk-chase">
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
          <div class="sk-chase-dot"></div>
        </div>
    </div>
</div>
<!-- END LOADER --> 
 @yield('header')

 @yield('content')
 
 @include('partials.logout')

 @include('partials.footer')



@stack('scripts')

@if($liveChatScript && $liveChatScript->script_code)
    {!! $liveChatScript->script_code !!}
@endif


</body>
</html>