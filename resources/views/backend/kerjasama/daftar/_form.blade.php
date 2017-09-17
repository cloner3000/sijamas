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
              <div class="col-md-12">
                
                {!! Form::model($model, ['class'=>'panel-body p-y-1', 'files'=>true]) !!} 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Judul :</label>
                      <div class="col-sm-8">
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Nomor Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('cooperation_number' , null ,['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategori Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_category' , 'dn' ,null, ['class' => 'custom-control-input']) !!}
                          <span class="custom-control-indicator"></span>
                          DN
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_category' , 'ln' ,null, ['class' => 'custom-control-input']) !!}
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
                          
                          {!! Form::radio('cooperation_status' , 'baru' ,null, ['class' => 'custom-control-input']) !!}
                          <span class="custom-control-indicator"></span>
                          Baru
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_status' , 'lanjutan' ,null, ['class' => 'custom-control-input']) !!}
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
                        {!! Form::select('cooperation_type_id', $data['cooperationType'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tentang Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('about' , null ,['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Mitra Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('partners' , null ,['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Lokasi Kerjasama :</label>
                      <div class="col-sm-8">
                        <div class="row">
                          <div class="col-md-6">                            
                            
                            {!! Form::select('cooperation_province_id', $data['province'], null ,['class' => 'form-control select2-example province', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!}  
                          </div>
                          <div class="col-md-6">                        
                            {!! Form::select('cooperation_city_id', $data['city'], $model->cooperation_city_id ? $model->cooperation_city_id : null ,['class' => 'form-control select2-example city', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                          </div>
                        </div>
                        <div class="row p-y-2">
                            <div class="col-md-12">
                              {!! Form::text('address' , null ,['class' => 'form-control']) !!}
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
                              {!! Form::text('cooperation_signed' , isset($model->cooperation_signed) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_signed)->format('d/m/Y') : null ,['class' => 'form-control']) !!}
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
                              {!! Form::text('cooperation_ended' , isset($model->cooperation_ended) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_ended)->format('d/m/Y') : null ,['class' => 'form-control']) !!}
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
                        
                        {!! Form::select('cooperation_focus_id', $data['cooperationFocus'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Ruang Lingkup :</label>
                      <div class="col-sm-8">
                        {!! Form::textarea('scope' , null ,['id' => 'summernote-base']) !!}
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">File Dokumen :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input" name="file">
                          <span class="custom-file-control form-control">
                          Pilih File Dokumen...
                          </span>
                          @if($model->cooperationfile)
                          @foreach($model->cooperationfile as $file)
                            @if ($file->type == 'document') <label class="file_{{$file->id}}">{{ $file->filename }}</label> 
                            <button type="button" class="btn btn-danger px-file-browse deleteFile file_{{$file->id}}" data-id="{{$file->id}}">Hapus</button>
                            <br>
                             @endif
                          @endforeach
                          @endif
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Foto Dokumen Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input" name="image">
                          <span class="custom-file-control form-control">
                          Pilih Foto Dokumen...
                          </span>
                           @if($model->cooperationfile)
                          @foreach($model->cooperationfoto as $file)
                            @if ($file->type == 'photo') <label class="file_{{$file->id}}">{{ $file->filename }}</label> 
                            <button type="button" class="btn btn-danger px-file-browse deleteFile file_{{$file->id}}" data-id="{{$file->id}}">Hapus</button>
                            <br>
                            @endif
                          @endforeach
                          @endif 
                        </label>
                      </div>
                    </div>
                  </div>
                  
                 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 1 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('first_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama']) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('first_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 2 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('second_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama']) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('second_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 3 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('third_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama']) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('third_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Persetujuan Kerjasama :</label>
                      <div class="col-sm-8">                        
                        
                        {!! Form::select('approval', ['draft'=>'Draft', 'approved'=>'Approved', 'rejected'=>'Rejected', 'deleted'=>'Deleted'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
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
                  {!! Form::hidden('id' , null) !!}
                {!! Form::close() !!}
              </div>
            </div>
    </div>
@endsection

@push('script-js')

<script type="text/javascript" src="assets/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">  
    $(function() {
      $('#datepicker-range').datepicker({
        format:'dd/mm/yyyy'
      });

      $('.datepicker').datepicker({
        // format:'dd/mm/yy'
      });
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

    $('.deleteFile').click(function(){

      var r = confirm("Hapus Data?");
      if (r == true) {
          txt = "You pressed OK!";
      } else {
          return false;
      }

      var id = $(this).attr('data-id');

      // console.log(id);
      $.ajax({
        type : 'get',
        url : '{{ urlBackendAction("delete-file") }}',
        data : {
          id : id,
        },
        success : function(data){
          if (data.status == true) {
            $('.file_'+id).remove();
            swal("Hapus File !", "File Anda telah dihapus!", "success");
          } else {
            swal("Maaf", "File Anda tidak dapat dihapus!", "info");
          }
          
        },
      });
    })

    $('.province').change(function(){
      var id = $(this).val();
      var html = '';

      $.ajax({
        type : 'get',
        url : '{{ urlBackendAction("city") }}',
        data : {
          id : id,
        },
        success : function(data){
          $('.city').html('');
          if (data.status == true) {
            $.each(data.res, function( index, val ) {
              html += '<option value='+index+'>'+val+'</option>';
            })
            $('.city').append(html);
          } else {
            return false;  
          }
          
        },
      });
    })
</script>
@endpush