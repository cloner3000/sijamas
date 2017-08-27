<div class=" col-lg-4 col-md-4">
	<div class="right-content">

		<div class="rows">
			<div class="widget-title"><h4>Kerjasama Terbaru</h4><hr></div>
			@if($kerjasama)
			@foreach($kerjasama as $val)
			<div class="rows-berita big-side-news">
				<div class="box-news bg-green">
  					<div class="title-h-news">
  						<h3><a href="#">{{ $val->title }} </a></h3>
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
						    {!! $val->scope !!}	
						  </div>
						</div>
  					</div><!--en.isi-h-news-->
  				</div><!--end.box-news-->
			</div><!--end.rows-->
			@endforeach
			@endif
		</div><!--end.rows-->
	</div>
</div><!--end.col-3-->
