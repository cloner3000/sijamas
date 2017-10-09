@extends('frontend.layouts.layout')

@section('content')

<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>

			@if(!empty($get['kategori']))
				@if($get['kategori'] == 'ln')
			  		<li class="active">Kategori Kerjasama Luar Negeri</li>
				@elseif($get['kategori'] == 'dn')
			  		<li class="active">Kategori Kerjasama Dalam Negeri</li>
				@else 
			  		<li class="active">Kategori Kerjasama Dalam/Luar Negeri</li>
				@endif
			@else			
			  		<li class="active">Kategori Kerjasama Dalam/Luar Negeri</li>
			@endif
			  
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-8 col-md-8">
					<div class="left-content">
						<div class="kerjasama-page">
						@if($model->total() > 0)
							{{-- 
							@if(!empty($get['kategori']))
								@if($get['kategori'] == 'ln')
									<h3>Kategori Kerjasama Luar Negeri</h3>
								@elseif($get['kategori'] == 'dn')
									<h3>Kategori Kerjasama Dalam Negeri</h3>
								@else 
								  	<h3>Kategori Kerjasama Dalam/Luar Negeri</h3>
								@endif
							@else
								<h3>Kategori Kerjasama Dalam/Luar Negeri</h3>
							@endif
							--}}
							<h3>{{ $model->total()}} Data tidak ditemukan</h3>
						@else
							<h3>Maaf, Data tidak ditemukan</h3>
						@endif
							<div class="rows">
								<div class="list-berita">
									@if($model)
									@foreach($model as $val)
									
									<div class="rows-berita inline-news">
										<div class="box-news">
						  					<div class="title-h-news">
						  						<h3><a href="{{url('kategori-kerjasama/read/'.$val->slug)}}">{{ $val->title }}</a></h3>
						  						<span class="date-h">{{ $val->about}}</span>
						  					</div>
						  					<div class="isi-h-news">
						  						<div class="media">
												  @if($val->cooperationfile)
												  @if(isset($val->cooperationfoto[0]))
												  
												  <div class="media-left">
												    <a href="#">
												      <img class="media-object" src="{{ asset('contents/file/'.$val->cooperationfoto[0]->filename)}}" alt="berita">
												    </a>
												  </div>
												  
												  @endif
												  @endif
												  <div class="media-body">
												  	<span class="fontBlue1">
												  		@if($val->cooperation_category == 'ln')
												  		Kerjasama Luar negeri
												  		@else
												  		Kerjasama Dalam negeri
												  		@endif
												  	</span><br>
												  	<span class="fontGreen1">{{ $val->cooperation_number}}</span><br>
												  	<span class="fontBlue1">{{ $val->cooperationtype->name }}</span><br>
												  	<span class="fontGreen1">Status: {{ $val->cooperation_status }}</span><br>
												  	<span class="fontGreen1">Tahun Penandatanganan : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $val->cooperation_signed)->format('Y')}}</span><br>
												  	<span class="fontGreen1">Tahun Berakhir : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $val->cooperation_ended)->format('Y')}}</span><br><br>
												  </div>
												    <p>{!! $val->scope !!}</p>
												</div>
						  					</div><!--en.isi-h-news-->
						  				</div><!--end.box-news-->
									</div><!--end.rows-berita-->
									
									@endforeach
									@endif
									<!--
									<div class="rows-berita inline-news no-image">
										<div class="box-news">
						  					<div class="title-h-news">
						  						<h3><a href="{{url('kategori-kerjasama/read/1')}}">Lorem Ipsum is simply dummy text </a></h3>
						  						<span class="date-h">Selasa, 12 Juli 2017 09:34 WIB</span>
						  					</div>
						  					<div class="isi-h-news">
						  						<div class="media">
												  <div class="media-body">
												  	<span class="fontBlue">Kerjasama Luar Negeri</span><br>
												  	<span class="fontGreen">Payung Kerjasama</span><br>
												  	<span class="fontBlue">Bidang Teknologi dan Informasi</span><br>
												  	<span class="fontGreen">Status: Baru</span><br>
												  	<span class="fontGreen">Tahun Penandatanganan : 2010</span><br>
												  	<span class="fontGreen">Tahun Berakhir : 2010</span><br><br>
												    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.</p>
												  </div>
												</div>
						  					</div>
						  				</div>
									</div>
									-->
									
									{!! $model->setPath('')->render() !!}
									<!-- <div class="text-center paging">
										<ul class="pagination pagination-info">
											<li><a href="#"><</a></li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li class="active"><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#">></a></li>
										</ul>
									</div> -->
								</div><!--end.list-berita-->
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
