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
							<h3>Sistem Informasi Kerjasama Standarisasi dan Penilaian Kesesuaian</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies leo congue, tempor arcu a, finibus risus. Praesent auctor rutrum ante, eget sollicitudin lacus faucibus nec. Donec ultrices, tellus sit amet malesuada imperdiet, justo ipsum elementum velit, sit amet malesuada tortor est id nisl. Nunc nunc lectus, venenatis non nisi ut, molestie varius tellus. Donec molestie convallis sem ullamcorper tempor. Sed tempor felis efficitur, ornare nisi a, porta tellus. Nulla mollis eget nibh porttitor accumsan.</p>
							<p>
							Praesent pharetra ante sapien, eget bibendum justo iaculis quis. Quisque sed sodales orci. Suspendisse at ligula tempor est convallis pretium non non est. Vestibulum rutrum nibh quis libero fringilla ultricies. Vivamus blandit tincidunt mi sed auctor. Integer vitae metus at neque consectetur pretium. Sed tincidunt eget orci lacinia suscipit. In ac nisi ultrices, ornare sapien tincidunt, lacinia urna. Cras ornare faucibus velit nec luctus. Aliquam a consectetur libero.</p>
							<p>
							Nam mattis odio et rutrum semper. Etiam consequat mollis neque, non dictum neque rutrum sit amet. Ut non pretium elit. Vivamus vitae vestibulum odio, vel scelerisque ipsum. Nulla ornare risus dui, et fermentum purus pulvinar id. Mauris non pretium turpis, quis efficitur sem. Nunc imperdiet, purus a dignissim semper, enim metus elementum augue, eget pellentesque metus lorem ut ipsum. Pellentesque et neque congue, faucibus elit at, varius libero. Pellentesque purus justo, tristique vitae lorem nec, hendrerit viverra neque. Duis sit amet eros quis arcu vulputate egestas. Duis ac mauris maximus, fringilla augue eleifend, lacinia arcu. Integer finibus auctor tincidunt.</p>
							<p>
							Pellentesque gravida, purus at imperdiet consectetur, ligula justo blandit ipsum, eget tristique est sapien non arcu. Curabitur ac euismod augue, at dignissim augue. Nam sit amet nisl dui. Sed metus diam, finibus a nibh vel, rutrum consequat sapien. Proin convallis elit eu tempor hendrerit. Morbi ultricies sit amet odio eget placerat. Mauris suscipit lectus in justo blandit, at luctus augue tristique. Sed id auctor massa. Vivamus sed augue vitae tellus auctor ultricies.</p>
							<p>
							Vestibulum gravida, nunc pharetra congue sagittis, erat nunc sagittis mauris, at convallis mi arcu sit amet purus. Proin cursus tincidunt mauris sit amet semper. Aliquam varius vulputate justo et mollis. Proin turpis felis, congue a nibh eget, pretium hendrerit metus. Suspendisse nec tempus sapien, id ornare eros. Aliquam aliquam sit amet nisi nec hendrerit. Nam pulvinar risus eu mauris pretium, ut bibendum mauris fringilla. Aenean ut tristique mauris, nec pretium sapien.</p>
							<p>
							Nam mattis odio et rutrum semper. Etiam consequat mollis neque, non dictum neque rutrum sit amet. Ut non pretium elit. Vivamus vitae vestibulum odio, vel scelerisque ipsum. Nulla ornare risus dui, et fermentum purus pulvinar id. Mauris non pretium turpis, quis efficitur sem. Nunc imperdiet, purus a dignissim semper, enim metus elementum augue, eget pellentesque metus lorem ut ipsum. Pellentesque et neque congue, faucibus elit at, varius libero. Pellentesque purus justo, tristique vitae lorem nec, hendrerit viverra neque. Duis sit amet eros quis arcu vulputate egestas. Duis ac mauris maximus, fringilla augue eleifend, lacinia arcu. Integer finibus auctor tincidunt.</p>

						</div>
					</div>
				</div><!--end. col-lg-9 col-md-9-->

				@include('frontend.layouts.sidebar')
			</div>
		</div><!--end.wrapper-->
	</div><!--end.page-content-->
</div>
@endsection
