@extends('frontend.layouts.layout')

@section('content')
<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Profile</li>
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-8 col-md-8">
					<div class="left-content">
						<div class="inner-page-content">
							<h3>{{ $model->title }}</h3>
							<p>{!! $model->description !!}</p>

						</div>
					</div>
				</div><!--end. col-lg-9 col-md-9-->

				@include('frontend.layouts.sidebar')
			</div>
		</div><!--end.wrapper-->
	</div><!--end.page-content-->
</div>
@endsection
