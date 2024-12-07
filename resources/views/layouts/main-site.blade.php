<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Templatemanja" name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="if you are looking for the best free restaurant, you better not miss checking out They are all you need to introduce your restaurant and food business to the world.">
<meta name="keywords" content="	asian food, Fast Food, cafe, bar, bbq, restaurant, sushi, steakhouse, pizza, Mexican Food, menu, meat, Breakfast, Lunch, Dinner, Delicious, Tasty, Snack, Wine, Cola, html, template, css, Restaurant Web Templates.">

<!-- SITE TITLE -->
<title>@yield('title')</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.png">
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
 
 
 @include('partials.footer')



@stack('scripts')

@if($liveChatScript && $liveChatScript->script_code)
    {!! $liveChatScript->script_code !!}
@endif


</body>
</html>