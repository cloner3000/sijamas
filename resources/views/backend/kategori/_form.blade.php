@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Kategory Kerjasama</li>
      <li class="active">Tambah</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Kategory Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-8">
                <form action="#" method="post" class="panel-body p-y-1">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Nomor Kerjasama :</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" placeholder="Silahkan Masukkan Nomor Kerjasama">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategori Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-3" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          DN
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-3" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          LN
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategori Status Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-4" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Baru
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-4" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Lanjutan
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jenis Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-5" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Payung Kerjasama
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-5" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Perjanjian Kerjasama
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-5" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Lainnya
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tentang Kerjasama :</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" placeholder="Silahkan Masukkan Tentang Kerjasama">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Mitra Kerjasama :</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" placeholder="Silahkan Masukkan Nama Mitra Kerjasama">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Lokasi Kerjasama :</label>
                      <div class="col-sm-8">
                        <div class="row">
                          <div class="col-md-6">                            
                            <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                              <option>Pilih Province</option>
                              <option value="AK">DKI JAKARTA</option>
                              <option value="AK">SURABAYA</option>
                            </select>   
                          </div>
                          <div class="col-md-6">                        
                            <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                              <option>Pilih Kota</option>
                              <option value="AK">kepulauan seribu</option>
                              <option value="AK">Juanda</option>
                            </select>
                          </div>
                        </div>
                        <div class="row p-y-2">
                            <div class="col-md-12">
                              <textarea class="form-control" placeholder="Silahkan Masukkan Lokasi Lengkap Kerjasama"></textarea>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="input-daterange" id="datepicker-range">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-4 control-label">Dari Tanggal :</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control" name="start">
                              <span class="input-group-btn">
                                <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-4 control-label">Sampai Tanggal :</label>
                        <div class="col-sm-8">                  
                            <div class="input-group m-b-2">
                              <input type="text" class="form-control" name="end">
                              <span class="input-group-btn">
                                <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Bidang Fokus :</label>
                      <div class="col-sm-8">                        
                        <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                          <option>Pilih Bidang Fokus Kerjasama</option>
                          <option value="AK">Pendidikan</option>
                          <option value="AK">Pangan Pertanian</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Ruang Lingkup :</label>
                      <div class="col-sm-8">
                        <textarea id="summernote-base">Summernote Editor</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">File Dokumen :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input">
                          <span class="custom-file-control form-control">Choose file...</span>
                          <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear">Clear</button>
                            <button type="button" class="btn btn-primary px-file-browse">Upload</button>
                          </div>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Foto Dokumen Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input">
                          <span class="custom-file-control form-control">Choose file...</span>
                          <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear">Clear</button>
                            <button type="button" class="btn btn-primary px-file-browse">Upload</button>
                          </div>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Persetujuan Kerjasama :</label>
                      <div class="col-sm-8">                        
                        <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                          <option value="AK">Approve</option>
                          <option value="AK">Reject</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">
                        <button type="submit" class="btn btn-primary btn-3d">Save</button>
                      </label>
                      <div class="col-sm-8">                  
                          &nbsp;
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
    </div>
@endsection

@push('script-js')

<script type="text/javascript" src="assets/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">  
    $(function() {
      $('#datepicker-range').datepicker();

      $('#datepicker').datepicker();
      $('#summernote-base').summernote({
        height: 200,
        toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'video', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
        ],
      });
    });
</script>
@endpush