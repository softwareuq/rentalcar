<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('images/icon/faviconpanel.ico')}}" type="image/x-icon"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title','RentalCar')</title>
    <link rel="stylesheet" href="{{asset('css/footer.css')}}" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('template/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/silder.css')}}">
    <link rel="stylesheet" href="{{asset('animate/animate.min.css')}}">

  </head>
  <body>

    @include('front/template/header')
    @include('front/template/slide')
    <br>
    <h2 align="center" style="color:#44AD87;font: normal 36px 'Cookie', cursive;margin: 0;">Nuestros Vehículos</h2>
    <br>
    <div class="container-fluid">
      <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" style="border-radius: 10px 10px 10px 10px;-moz-border-radius: 10px 10px 10px 10px;-webkit-border-radius: 10px 10px 10px 10px;border: 0px solid #000000;-webkit-box-shadow: -2px 4px 79px 3px rgba(0,0,0,0.55);-moz-box-shadow: -2px 4px 79px 3px rgba(0,0,0,0.55);box-shadow: -2px 4px 79px 3px rgba(0,0,0,0.55);">
        @yield('content')
      </div>
      <div class="col-lg-3 col-md-0 col-sm-0 col-xs-0">
        @include('front/template/aside')
      </div>
    </div>

    <br><br>
    @include('front/template/ubicacion')
    @include('front/template/footer')

    <script type="text/javascript" src="{{asset('jquery/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/silder.js')}}"></script>
    <script type="text/javascript" src="{{asset('animate/animatedModal.js')}}"></script>
    @yield('js')
  </body>
</html>
