@extends('frontend.layouts.layout')

@section('content')

<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Kategori Kerjasama</li>
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-8 col-md-8">
					<div class="left-content">
						<div class="kerjasama-page">
							<h3>Kategori Kerjasama</h3>
							<div class="rows">
								<div class="box-form">
									<form>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Kategori Kerjasama</label>
					                              <select class="form-control">
					                                <option> -- Pilih Kategori Kerjasama -- </option>
					                                <option>Kerjasama Luar Negeri</option>
					                                <option>Kerjasama Dalam Negeri</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Bidang Fokus</label>
					                              <select class="form-control">
					                                <option> -- Pilih Bidang Fokus -- </option>
					                                <option>Teknologi Informasi</option>
					                                <option>Pendidikan</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
										</div><!--end.row-->
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Jenis Kerjasama</label>
					                              <select class="form-control">
					                                <option> -- Pilih Jenis Kerjasama -- </option>
					                                <option>Payung Kerjasama</option>
					                                <option>Perjanjian Pelaksana</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Tahun Penandatanganan</label>
					                              <select class="form-control">
					                                <option> -- Pilih Tahun -- </option>
					                                <option>2011</option>
					                                <option>2012</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
										</div><!--end.row-->
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Status Kerjasama</label>
					                              <select class="form-control">
					                                <option> -- Pilih Status Kerjasama -- </option>
					                                <option>Baru</option>
					                                <option>Lanjutan</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
					                              <label>Tahun Berakhir</label>
					                              <select class="form-control">
					                                <option> -- Pilih Tahun -- </option>
					                                <option>2017</option>
					                                <option>2018</option>
					                              </select>
					                            </div><!--end.form-group-->
											</div>
										</div><!--end.row-->
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
					                              <label>Periode Pencarian</label>
					                              <div class="row">
					                                  <div class="col-md-4 col-sm-4">
					                                      <select class="form-control">
					                                        <option> -- Pilih Jenis Periode -- </option>
					                                        <option>Tanggal Terbaru</option>
					                                      </select>
					                                  </div>
					                                  <div class="col-md-3 col-sm-3 col-xs-6">
					                                      <div class="inner-addon right-addon">
					                                        <i class="fa fa-calendar" aria-hidden="true"></i>
					                                        <input type="text" class="form-control datepicker1"/>
					                                      </div>
					                                  </div>
					                                  <div class="col-md-1 col-sm-1 hidden-xs  text-center">
					                                    <span>Sampai</span>
					                                  </div>
					                                  <div class="col-md-3 col-sm-3 col-xs-6">
					                                     <div class="inner-addon right-addon">
					                                        <i class="fa fa-calendar" aria-hidden="true"></i>
					                                        <input type="text" class="form-control datepicker2  "/>
					                                      </div>
					                                  </div>
					                              </div>
					                            </div><!--end.form-group-->
											</div>
										</div><!--end.row-->
										<div class="rows">
			                              <button type="submit" class="btn btn-primary">Tampilkan</button>
			                              <button type="submit" class="btn btn-default">Reset</button>
			                            </div>
									</form>
								</div>
							</div>
							<div class="rows">
								<div class="list-berita">
									@if($model)
									@foreach($model as $val)
									<div class="rows-berita inline-news">
										<div class="box-news">
						  					<div class="title-h-news">
						  						<h3><a href="{{url('kategori-kerjasama/read/1')}}">{{ $val->title }}</a></h3>
						  						<span class="date-h">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $val->created_at)->format('j F Y')}}</span>
						  					</div>
						  					<div class="isi-h-news">
						  						<div class="media">
												  @if($val->cooperationfile)
												  @foreach($val->cooperationfile as $file)
												  @if($file->type == 'photo')
												  <div class="media-left">
												    <a href="#">
												      <img class="media-object" src="{{ asset('contents/file/'.$file->filename)}}" alt="berita">
												    </a>
												  </div>
												  @endif
												  @endforeach
												  @endif
												  <div class="media-body">
												  	<span class="fontBlue">
												  		@if($val->cooperation_category == 'ln')
												  		Kerjasama Luar negeri
												  		@else
												  		Kerjasama Dalam negeri
												  		@endif
												  	</span><br>
												  	<span class="fontGreen">{{ $val->cooperation_number}}</span><br>
												  	<span class="fontBlue">{{ $val->cooperationtype->name }}</span><br>
												  	<span class="fontGreen">Status: {{ $val->cooperation_status }}</span><br>
												  	<span class="fontGreen">Tahun Penandatanganan : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $val->cooperation_signed)->format('Y')}}</span><br>
												  	<span class="fontGreen">Tahun Berakhir : {{ \Carbon\Carbon::createFromFormat('Y-m-d', $val->cooperation_ended)->format('Y')}}</span><br><br>
												    <p>{!! $val->scope !!}</p>
												  </div>
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
									

									<div class="text-center paging">
										<ul class="pagination pagination-info">
											<li><a href="#"><</a></li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li class="active"><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#">></a></li>
										</ul>
									</div>
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
