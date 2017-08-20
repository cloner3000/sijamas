@extends('frontend.layouts.layout')

@section('content')

<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Kontak Kami</li>
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-12 col-md-12">
					<div class="left-content">
						<div class="kontak-page">
							<h3>Kontak Kami</h3>
							<div class="rows">	
								<div class="row">
									<div class="col-md-6">
										<div class="contact-info">
											<h5>Pusat Kerjasama Standarisasi</h5>
											<div class="rows">
												<div class="call-row">
													<div class="text-call"><i class="fa fa-phone" aria-hidden="true"></i> +62-87829-0878</div>
												</div>
												<div class="call-row">
													<div class="text-call"><i class="fa fa-envelope" aria-hidden="true"></i> admin@gmail.com</div>
												</div>
											</div>
											<div class="rows">
												<div class="address-row">
													<div class="text-address">
													Gedung I BPPT<br>Jl. M.H. Thamrin No.8<br>Kebon Sirih, Jakarta Pusat 10340 </div>
												</div>
											</div>
										</div>
									</div><!--end.col-md-6-->
									<div class="col-md-6">
										<div class="maps">
											<script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:340px;width:100%;'><div id='gmap_canvas' style='height:440px;width:700px;'></div><div><small><a href="http://embedgooglemaps.com">Click here to generate your map!</a></small></div><div><small><a href="https://ultimatewebtraffic.com/product/us-states-targeted-traffic/">Geniune US peoples to visit your website. Look for them right away!</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><script type='text/javascript'>function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(-6.17511,106.86503949999997),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(-6.17511,106.86503949999997)});infowindow = new google.maps.InfoWindow({content:'<strong>Title</strong><br>jakarta, indonesia<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
										</div>
									</div><!--end.col-md-6-->
								</div>
							</div><!--end.rows-->
						</div>
					</div><!--end.left-content-->
				</div><!--end. col-lg-12 col-md-12-->
			</div>
		</div><!--end.wrapper-->
	</div><!--end.page-content-->
</div>
<!-- end of middle -->
@endsection
