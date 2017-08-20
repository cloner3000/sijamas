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
							<div class="row">
								<div class=" col-lg-8 col-md-8 col-md-offset-1 col-lg-offset-1">
									<div class="inner-form">
										<div class="form-group label-floating">
											<label class="control-label">Nama Pengusul*</label>
											<input type="text" class="form-control">
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Instansi*</label>
											<input type="text" class="form-control">
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Jabatan*</label>
											<input type="text" class="form-control">
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Alamat*</label>
											<textarea class="form-control"  rows="5"></textarea>
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Telepon*</label>
											<input type="text" class="form-control">
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Email*</label>
											<input type="email" class="form-control">
										</div><!--end.form-group-->
										<div class="form-group label-floating">
											<label class="control-label">Isi Pesan*</label>
											<textarea class="form-control"  rows="5"></textarea>
										</div><!--end.form-group-->
										<div class="form-group">
											<label>Jenis naskah kerjasama yang diusulkan*</label>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Nota Kesepahaman (Payung Kerjasama)
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Perjanjian Kerjasama
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" name="optionsRadios">
													Lainnya
												</label>
											</div>
										</div><!--end.form-group-->
										<div class="form-group">
											<label>Draft file kerjasama*</label>
											<input type="file" id="file-input" name="file">
											<input type="text" class="form-control inputFile">
											<div class="browse-img"><img src="images/material/browse.png"></div>
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

			                              <button type="submit" class="btn btn-primary right">Kirim</button>
			                            </div>
			                            <div class="form-group">
			                            	<span class="red-help">*Wajib diisi</span>
			                            </div>
									</div><!--end.inner-form-->
								</div>
							</div><!--end.row-->
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