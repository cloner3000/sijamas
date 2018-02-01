@extends('frontend.layouts.layout')

@section('content')

<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  
			  @if($model->cooperation_category == 'ln')
			  <li><a href="#">Kategori Kerjasama Luar Negeri</a></li>
			  <li><a href="{{ url('kategori-kerjasama/luar-negeri')}}">Kerjasama Luar Negeri</a></li>
			  @else
			  <li><a href="#">Kategori Kerjasama Dalam Negeri</a></li>
			  <li><a href="{{ url('kategori-kerjasama/dalam-negeri')}}">Kerjasama Dalam Negeri</a></li>
			  @endif
			  <li class="active">{{$model->title}}</li>
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-8 col-md-8">
					<div class="left-content">
						<div class="detail-Berita">
							<div class="entry-header">
								<h1 class="entry-title h1">{{ $model->title }}</h1>
								<div class="entry-meta entry-meta-single">
									<div class="meta-item herald-date"><span class="updated">{{ $model->about }}</span></div>
								</div> 
							</div><!--end.entry-hedaer-->
							
							@if(count($image) > 0)
							<div class="slider-detail">
								<div class="row">
									<div class="col-md-9">
										<div class="bx-main">
											<ul id="bxslider">
												
												@foreach ($image as $foto)
												<?php 
												$file = isset($foto->filename) ? $foto->filename : $foto->image;
												?>
												<li><img src="{{ asset(null) }}contents/file/{{$file}}" alt="" title="{{ (!empty($foto->activity_type)) ? $foto->activity_type : $foto->title }}"></li>
												@endforeach
												
												
			    							</ul>
		    							</div>
	    							</div>

    							<!--The thumbnails-->
    							<div class="col-md-3">
	    							<div class="carousel-bx-main">
		    							<ul id="bxslider-pager">
											@if($image)
											@foreach ($image as $key => $foto)
											<?php 
											$file = isset($foto->filename) ? $foto->filename : $foto->image;
											?>
											<li data-slideIndex="{{$key}}"><a href=""><img src="{{ asset(null) }}contents/file/{{$file}}" alt=""></a></li>
											@endforeach
											@endif

										</ul>
									</div>
								</div>
								</div><!--end.row-->
							</div><!--end.slider-detail-->
							@endif
							<div class="isi-berita">
								<div class="rows">
								<div class="col-lg-12">
									<div class="profile-user-info">
										<div class="profile-info-row">
											<div class="profile-info-name"> Nomor Kerjasama : </div>

											<div class="profile-info-value">
												<span>{{ $model->cooperation_number}}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Kategori Kerjasama : </div>

											<div class="profile-info-value">
												<span>{{ strtoupper($model->cooperation_category) }}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Kategori Status Kerjasama : </div>

											<div class="profile-info-value">
												<span>{{ ucfirst($model->cooperation_status) }}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Jenis Kerjasama :</div>

											<div class="profile-info-value">
												<span>Payung Kerjasama</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Mitra Kerjasama :</div>

											<div class="profile-info-value">
												<span>{{ $model->partners }}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Lokasi Kerjasama :</div>

											<div class="profile-info-value">
												<span>{{ $model->city->name}}, {{ $model->province->name}} </span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Tanggal Penandatanganan Kerjasama :</div>

											<div class="profile-info-value">
												<span>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_signed)->format('j F Y')}}</span>
											</div>
										</div><!--.profile-info-row-->
										<!-- <div class="profile-info-row">
											<div class="profile-info-name"> Lama Berlaku Kerjasama :</div>

											<div class="profile-info-value">
												<span>5 Tahun</span>
											</div>
										</div> -->
										<!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Tanggal Berakhir Kerjasama :</div>

											<div class="profile-info-value">
												<span style="{{$end}}">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_ended)->format('j F Y')}}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Bidang Fokus :</div>

											<div class="profile-info-value">
												<span>{{ $model->cooperationfocus->name}}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> Ruang Lingkup :</div>

											<div class="profile-info-value">
												<span>{!! $model->scope !!}</span>
											</div>
										</div><!--.profile-info-row-->
										<div class="profile-info-row">
											<div class="profile-info-name"> File Dokumen :</div>

											<div class="profile-info-value">
												@if($model->cooperationfile)
												@foreach ($model->cooperationfile as $file)
												<span><a href="javascript:void(0)" onclick="return alert('Hubungi Admin untuk mendownload')"> {{ $file->filename}}</a></span><br>
												@endforeach
												@endif
											</div>
										</div><!--.profile-info-row-->
										
										<div class="profile-info-row full-row">
											<div class="profile-info-name"> Tindak Lanjut Implementasi :</div>

											<div class="profile-info-value">
												<table class="table">
													<thead>
														<tr>
															<th>Tanggal Implementasi</th>
															<th>Jenis Kegiatan</th>
															<th>Keterangan</th>
														</tr>
													</thead>
													<tbody>
														@if($model->cooperationimplementation)
														@foreach ($model->cooperationimplementation as $imp)
														@if($imp->category == 'implementation')
														<tr>
															<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $imp->implementation_date)->format('j F Y')}}</td>
															<td>{{ $imp->activity_type}}</td>
															<td>{!! $imp->description !!}</td>
														</tr>
														@endif
													@endforeach
													@endif
													</tbody>
												</table>
											</div>
										</div><!--.profile-info-row-->
									</div><!--.profile-user-info-->
								</div>
								</div>
							</div>
						</div>
					</div><!--end.left-content-->
				</div><!--end. col-lg-9 col-md-9-->
				@include('frontend.layouts.sidebar')
				
			</div>
		</div><!--end.wrapper-->
	</div><!--end.page-content-->
</div>
@endsection
@push('script-js')

<script type="text/javascript">
	$(window).load(function(){
 

var realSlider= $("ul#bxslider").bxSlider({
      speed:1000,
      pager:false,
      captions: true,
      nextText:'',
      prevText:'',
      infiniteLoop:false,
      hideControlOnEnd:true,
      onSlideBefore:function($slideElement, oldIndex, newIndex){
        changeRealThumb(realThumbSlider,newIndex);
        
      }
      
    });

	if (screen.width < 500) {
		var realThumbSlider=$("ul#bxslider-pager").bxSlider({
	      minSlides: 2,
	      maxSlides: 2,
	      slideWidth: 156,
	      slideMargin: 12,
	      moveSlides: 1,
	      pager:false,
	      speed:1000,
	      infiniteLoop:false,
	      hideControlOnEnd:true,
	      nextText:'<span></span>',
	      prevText:'<span></span>',
	      onSlideBefore:function($slideElement, oldIndex, newIndex){
	        /*$j("#sliderThumbReal ul .active").removeClass("active");
	        $slideElement.addClass("active"); */

	      }
	    });
	    
	}
	else if (screen.width < 900) {
		var realThumbSlider=$("ul#bxslider-pager").bxSlider({
	      minSlides: 4,
	      maxSlides: 4,
	      slideWidth: 156,
	      slideMargin: 12,
	      moveSlides: 1,
	      pager:false,
	      speed:1000,
	      infiniteLoop:false,
	      hideControlOnEnd:true,
	      nextText:'<span></span>',
	      prevText:'<span></span>',
	      onSlideBefore:function($slideElement, oldIndex, newIndex){
	        /*$j("#sliderThumbReal ul .active").removeClass("active");
	        $slideElement.addClass("active"); */

	      }
	    });
	}

	else {

	    var realThumbSlider=$("ul#bxslider-pager").bxSlider({
		mode: 'vertical',
	      minSlides: 4,
	      maxSlides: 4,
	      slideWidth: 156,
	      slideMargin: 12,
	      moveSlides: 1,
	      pager:false,
	      speed:1000,
	      infiniteLoop:false,
	      hideControlOnEnd:true,
	      nextText:'<span></span>',
	      prevText:'<span></span>',
	      onSlideBefore:function($slideElement, oldIndex, newIndex){
	        /*$j("#sliderThumbReal ul .active").removeClass("active");
	        $slideElement.addClass("active"); */

	      }
	    });
	}
	    
    
    
    linkRealSliders(realSlider,realThumbSlider);
    
    if($("#bxslider-pager li").length<5){
      $("#bxslider-pager .bx-next").hide();
    }

// sincronizza sliders realizzazioni
function linkRealSliders(bigS,thumbS){
  
  $("ul#bxslider-pager").on("click","a",function(event){
    event.preventDefault();
    var newIndex=$(this).parent().attr("data-slideIndex");
        bigS.goToSlide(newIndex);
  });
}

//slider!=$thumbSlider. slider is the realslider
function changeRealThumb(slider,newIndex){
  
  var $thumbS=$("#bxslider-pager");
  $thumbS.find('.active').removeClass("active");
  $thumbS.find('li[data-slideIndex="'+newIndex+'"]').addClass("active");
  
  if(slider.getSlideCount()-newIndex>=4)slider.goToSlide(newIndex);
  else slider.goToSlide(slider.getSlideCount()-4);

}

});//]]> 
</script>
@endpush
