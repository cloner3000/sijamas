 <!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BSN</title>
<meta name="description" content="">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!--Style-->
<!--link rel="stylesheet" href="css/reset.css"-->
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}css/all.css">
<!--link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"-->
<!-- <link href="{{ asset(null) }}frontend/css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/js/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/camera.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bxslider/4.1.1/jquery.bxslider.css">
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/material-kit.css">
<link rel="stylesheet" href="{{ asset(null) }}frontend/css/style.css">
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media1024.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media768.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media480.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset(null) }}frontend/css/media320.css"/> -->
<!--link rel="stylesheet" href="css/style-temp.css"-->


</head>
<body>
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]--> 
<!-- header -->
<header id="mainheader">
  <div class="top-header">
    <div class="wrapper">
      <div class="left logo-top">
        <div class="main-logo"><a href="{{url('/')}}"><img src="{{ asset(null) }}frontend/images/material/logo.png"></a></div>
        <!-- <div class="text-logo">
          <span class="text-l1">Sistem Informasi Kerjasama Standarisasi dan Penilaian Kesesuaian (SIJAMAS)</span>
          <span class="text-l2">Badan Strandarisasi Nasional</span>
          <span class="text-l3">National Standardization Agency of Indonesia</span><img src="{{ asset(null) }}frontend/images/material/logo.png">
        </div> -->
      </div><!--end.left-->
      <div class="right text-right search-top">
        <div class="right-head">
          <div class="search-row" style="height: 50px">
            <!-- <input type="text" id="search" class="form-control" name="" placeholder="Search">
            <a href="#" class="searchTrigger"><i class="fa fa-search" aria-hidden="true"></i></a> -->
          </div>
          <div class="login-mn-row">
            <a href="admin/index.php" class="login popup">Login</a>
            <a href="#forgot" class="blue_ref popup">Lupa Password?</a>
            <a href="#pencarianLanjut" class="blue_ref popup">Pencarian Sijamas</a>
          </div>
        </div>
      </div><!--end.right-->
    </div>
  </div><!--end.top-header-->
  <div class="bottom-header">
    <div class="wrapper">
      <a href="#" id="trigger-menu">Menu</a>
      <div id="menu-desktop" class="main-menu">
        <ul>
          <li><a href="{{url('/')}}" class="{{(Request::segment(1)=='home') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{url('/profile')}}" class="{{ (Request::segment(1)=='profile') ? 'active' : '' }}">Profile</a></li>
          <li><a href="{{url('/usulan-kerjasama')}}" class="{{(Request::segment(1)=='usulan-kerjasama') ? 'active' : '' }}">Usulan Kerjasama</a></li>
          <li class="sub-menu-parent">
            <a href="#" class="{{(Request::segment(1)=='kategori-kerjasama') ? 'active' : '' }}">Kategori Kerjasama</a>
            <ul class="sub-menu">
                 <li><a href="{{url('/kategori-kerjasama/dalam-negeri')}}">Kerjasama Dalam Negeri</a></li>
                 <li><a href="{{url('/kategori-kerjasama/luar-negeri')}}">Kerjasama Luar Negeri</a></li>
               </ul>
          </li>
          <li><a href="{{url('/kontak-kami')}}" class="{{(Request::segment(1)=='kontak-kami') ? 'active' : '' }}">Kontak Kami</a></li>
        </ul>
      </div>
      <div id="mobile-menu" class="main-menu-mobile">
        <ul>
          <li><a href="{{url('/')}}" >Home</a></li>
          <li><a href="{{url('/profile')}}">Profile</a></li>
          <li><a href="{{url('/usulan-kerjasama')}}" >Usulan Kerjasama</a></li>
          <li class="sub-menu-parent">
            <a href="#">Kategori Kerjasama</a>
            <ul class="sub-menu">
                 <li><a href="{{url('/kategori-kerjasama/dalam-negeri')}}">Kerjasama Dalam Negeri</a></li>
                 <li><a href="{{url('/kategori-kerjasama/luar-negeri')}}">Kerjasama Luar Negeri</a></li>
               </ul>
          </li>
          <li><a href="{{url('/kontak-kami')}}">Kontak Kami</a></li>
        </ul>
        <div class="search-mobile">
          <div class="login-mn-row">
            <a href="#login" class="login popup">Login</a>
            <a href="#forgot" class="blue_ref popup">Lupa Password?</a>
            <a href="#pencarianLanjut" class="blue_ref popup">Pencarian Lanjutan</a>
          </div>
          <div class="search-row">
            <input type="text" id="search" class="form-control" name="" placeholder="Search">
            <a href="#" class="searchTrigger"><i class="fa fa-search" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div><!--end.bottom-header-->
</header>
<!-- end of header -->

