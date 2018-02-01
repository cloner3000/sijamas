<div class=" col-lg-4 col-md-4">
	<div class="right-content">

		<div class="rows">
			<div class="widget-title"><h4>Kerjasama Terbaru</h4><hr></div>
			@if($kerjasama)
			@foreach($kerjasama as $val)
			<div class="rows-berita big-side-news">
				<div class="box-news bg-green">
  					<div class="title-h-news">
  						<h3><a href="{{ url('kategori-kerjasama/read/'.$val->slug)}}">{{ $val->title }} </a></h3>
  						<p>{{ $val->about }}</p>
  					</div>
  					<div class="isi-h-news">
  						<div class="media">
						@if($val->cooperationfoto)
						  @if(isset($val->cooperationfoto[0]))
						  
						  <div class="media-left">
						  	
						    <a href="{{ url('kategori-kerjasama/read/'.$val->slug)}}">
						      <img class="media-object" src="{{ asset('contents/file/'.$val->cooperationfoto[0]->filename)}}" alt="berita">
						    </a>
						  </div>
						   
						  @endif
						  @endif
						  <!-- <div class="media-body">
						    {!! $val->scope !!}	
						  </div> -->
						</div>
  					</div><!--en.isi-h-news-->
  				</div><!--end.box-news-->
			</div><!--end.rows-->
			@endforeach
			@endif
		</div><!--end.rows-->
	</div>
</div><!--end.col-3-->
