@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Usulan Kerjasama</li>
      <li class="active">Tambah</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Usulan Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-8">
                <form action="#" method="post" class="panel-body p-y-1">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Nama Pengusul :</label>
                      <div class="col-sm-8">
                        <input type="text" name="email" class="form-control" value="Nila" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Instansi :</label>
                      <div class="col-sm-8">
                        <input type="text" name="email" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jabatan :</label>
                      <div class="col-sm-8">
                        <input type="text" name="email" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Alamat :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" readonly="readonly">GEdung I BPPT</textarea> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Telepon * :</label>
                      <div class="col-sm-8">
                        <input type="text" name="email" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Email * :</label>
                      <div class="col-sm-8">
                        <input type="text" name="email" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Isi Pesan :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control"></textarea> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jenis Naskah Kerjsama yang Diusulkan :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-4" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Nota Kesapahaman (Payung Kerjasama)
                        </label><br/>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-4" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Perjanjian Kerjasama
                        </label><br/>
                        <label class="custom-control custom-radio radio-inline">
                          <input type="radio" name="custom-radios-4" class="custom-control-input">
                          <span class="custom-control-indicator"></span>
                          Lainnya
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Draft File Kerjasama :</label>
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