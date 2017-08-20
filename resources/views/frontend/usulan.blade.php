@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="rows breadcums">
		<div class="wrapper">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Usulan Kerjasama</li>
			</ol>
		</div>
	</div>
	<div class="page-content">
		<div class="wrapper">
			<div class="row">
				<div class=" col-lg-8 col-md-8">
					<div class="left-content">
						<div class="form-content">
							<h3>Form Usulan Kerjasama</h3>
							
							{!! Form::model($data['model'],['files' => true, 'class'=>'panel-body p-y-1']) !!} 
							<div class="row">
								<div class=" col-lg-8 col-md-8 col-md-offset-1 col-lg-offset-1">
									<div class="inner-form">
										<div class="form-group label-floating">
											<label class="control-label">Nama Pengusul*</label>
											{!! Form::text('name' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Judul Usulan*</label>
											{!! Form::text('title' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Instansi*</label>
											{!! Form::text('institute' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Jabatan*</label>
											{!! Form::text('position' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Alamat*</label>
											{!! Form::textarea('address' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Telepon*</label>
											{!! Form::text('phone' , null ,['class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Email*</label>
											{!! Form::email('email' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Isi Pesan*</label>
											{!! Form::textarea('message' , null ,['class' => 'form-control']) !!}
										</div><!--end.form-group-->
										<div class="form-group">
											<label>Jenis naskah kerjasama yang diusulkan*</label>
												@if($data['type'])
                           							@foreach($data['type'] as $type)
													<div class="radio">
														<label>
																<input type="radio" name="proposed_cooperation_type_id" value="{{$type->id}}">
																{{$type->name}}
														</label>
													</div>
													@endforeach
												@endif
											
										</div><!--end.form-group-->
										<div class="form-group">
											<label>Draft file kerjasama*</label>
											<input type="file" id="file-input" name="filename">
											<input type="text" class="form-control inputFile">
											<div class="browse-img"><img src="frontend/images/material/browse.png"></div>
											<p class="help-block">Jenis file yang di upload: .pdf, .doc, .docs</p>
										</div><!--end.form-group-->
										<div class="form-group">
											<div class="captcha-row">
												<img src="images/material/captcha.gif" width="200">
												<input type="text" class="form-control " id="captchaInput" placeholder="type the character you see">
											</div>
										</div><!--end.form-group-->
										<div class="rows">
			                              <button type="submit" class="btn btn-default">Reset</button>
			                              <button type="submit" class="btn btn-danger">Batal</button>

			                              <button type="submit" class="btn btn-primary right">{{ !empty($model->id) ? 'Update' : 'Kirim' }}</button>
			                            </div>

			                            <div class="form-group">
			                            	<span class="red-help">*Wajib diisi</span>
			                            </div>
									</div><!--end.inner-form-->
								</div>
							</div><!--end.row-->
							{!! Form::close() !!}
						</div>
					</div>
				</div><!--end. col-lg-9 col-md-9-->
				@include('frontend.layouts.sidebar')
				
			</div>
		</div><!--end.wrapper-->
	</div><!--end.page-content-->
</div>
@endsection

@push('script-js')
<script>

$(document).ready(function(){
	$(".browse-img").click(function () {
    	$("#file-input").click();
	})

	$('#file-input').change(function () {
	    $('.inputFile').val($(this).val());
	})
});
</script>

@endpush