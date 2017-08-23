@extends('frontend.layouts.layout')

@section('content')
<div id="middle-content">
  <section id="banner-home" class="section">
  	 <div class="camera_wrap camera_magenta_skin" id="camera_wrap_2">
  	 	<div data-src="{{ asset(null) }}frontend/images/content/banner-home.png">
  			<div class="camera_caption fadeFromBottom">
    	     <a href="#"><p> Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like.</p></a>
        </div><!---end.caption-->
    	</div><!--end.banner-->
    </div>
  </section>
  <section id="bsn-middle" class="section">
  	<div class="wrapper">
  		<div class="title-section">
  			<h3>Selamat Datang di SIJAMAS</h3>
  		</div>
	  	<div class="box-border text-center">
	  		<div class="rows"><img src="{{ asset(null) }}frontend/images/material/logo.png"></div>
	  		<div class="rows">
	  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
	  			<!--<button class="btn btn-primary">SELENGKAPNYA</button>-->
	  		</div>
	  	</div>
  	</div><!--end.wrapper-->
  </section>
  <section id="home-highlights" class="section">
  	<div class="wrapper">
  		<div class="row list-h-news">
  			<div class="col-md-6">
  				<div class="widget-title"><h4>Kerjasama Terbaru</h4><hr></div>
  				<div class="box-news whitebox">
  					<div class="title-h-news">
  						<h3><a href="detail-berita.php">Lorem Ipsum is simply dummy text </a></h3>
  						<span class="date-h">Selasa, 12 Juli 2017 09:34 WIB</span>
  					</div>
  					<div class="isi-h-news">
  						<div class="media">
						  <div class="media-left">
						    <a href="detail-berita.php">
						      <img class="media-object" src="{{ asset(null) }}frontend/images/content/thumb1.jpg" alt="berita">
						    </a>
						  </div>
						  <div class="media-body">
						    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
						  </div>
						  <a href="indeks-berita.php" class="btn btn-success right">INDEX</a>
						</div>
  					</div><!--en.isi-h-news-->
  				</div><!--end.box-news-->
  			</div><!--end.col-md-4-->
  			
  			<div class="col-md-6">
  				<div class="widget-title"><h4>Usulan Kerjasama</h4><hr></div>
  				<div class="box-news whitebox">
  					<div class="isi-h-news">
						  <div class="media-body">
						    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
						  </div>
						  <a href="#" class="btn btn-primary right">Isi Form Usulan Kerjasama</a>
						</div>
  					</div><!--en.isi-h-news-->
  				</div><!--end.box-news-->
  			</div><!--end.col-md-4-->
  		</div>
  	</div><!--end,wrapper-->
  </section>
</div>
@endsection
@push('script-js')

<script type="text/javascript" src="{{ asset(null) }}frontend/js/camera.min.js"></script> 
<script>
$(function(){
  var 
    headheight = $( 'header' ).outerHeight(), 
    banner_height= $(window).height() - headheight ;
  jQuery('#camera_wrap_2').camera({
    loader: 'none',
    pagination: true,
    height: banner_height+"px",
    thumbnails: false,
    playPause: false,
    pauseOnClick: true,
    hover: true,
    time: 5000
  });
})
$(document).ready(function(){
  //$('.list-h-news').generate_height();
});
</script>

@endpush