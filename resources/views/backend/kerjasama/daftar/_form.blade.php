@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Kategori Kerjasama</li>
      <li class="active">Tambah</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Kategori Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12">
                @include('backend.common.flashes')
                {!! Form::model($model, ['class'=>'panel-body p-y-1', 'files'=>true]) !!} 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Judul :</label>
                      <div class="col-sm-8">
                        {!! Form::text('title' , null ,['class' => 'form-control', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Nomor Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('cooperation_number' , null ,['class' => 'form-control' , $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategori Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_category' , 'dn' ,null, ['class' => 'custom-control-input formid', $disabled]) !!}
                          <span class="custom-control-indicator"></span>
                          DN
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_category' , 'ln' ,null, ['class' => 'custom-control-input formid', $disabled]) !!}
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
                          
                          {!! Form::radio('cooperation_status' , 'baru' ,null, ['class' => 'custom-control-input formid', $disabled]) !!}
                          <span class="custom-control-indicator"></span>
                          Baru
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                          {!! Form::radio('cooperation_status' , 'lanjutan' ,null, ['class' => 'custom-control-input formid', $disabled]) !!}
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
                        {!! Form::select('cooperation_type_id', $data['cooperationType'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true, $disabled]) !!} 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tentang Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('about' , null ,['class' => 'form-control', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Mitra Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::text('partners' , null ,['class' => 'form-control', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Lokasi Kerjasama :</label>
                      <div class="col-sm-8">
                        <div class="row">
                          <div class="col-md-6">                            
                            
                            {!! Form::select('cooperation_province_id', $data['province'], null ,['class' => 'form-control select2-example province', 'style' => 'width: 100%', 'data-allow-clear'=>true,'required'=>'required', $disabled]) !!}  
                          </div>
                          <div class="col-md-6">                        
                            {!! Form::select('cooperation_city_id', $data['city'], $model->cooperation_city_id ? $model->cooperation_city_id : null ,['class' => 'form-control select2-example city','required'=>'required', 'style' => 'width: 100%', 'data-allow-clear'=>true, $disabled]) !!} 
                          </div>
                        </div>
                        <div class="row p-y-2">
                            <div class="col-md-12">
                              {!! Form::text('address' , null ,['class' => 'form-control', $disabled]) !!}
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
                              {!! Form::text('cooperation_signed' , isset($model->cooperation_signed) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_signed)->format('d/m/Y') : null ,['class' => 'form-control','required'=>'required', $disabled]) !!}
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
                              {!! Form::text('cooperation_ended' , isset($model->cooperation_ended) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_ended)->format('d/m/Y') : null ,['class' => 'form-control','required'=>'required', $disabled]) !!}
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
                        
                        {!! Form::select('cooperation_focus_id', $data['cooperationFocus'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true, $disabled]) !!} 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Ruang Lingkup :</label>
                      <div class="col-sm-8">
                        {!! Form::textarea('scope' , null ,['id' => 'summernote-base', $disabled]) !!}
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">File Dokumen :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input file" name="file">
                          <span class="custom-file-control form-control uploadFile">
                          Pilih File Dokumen...
                          </span>
                          <div class="px-file-buttons">
                            <button type="button" class="btn btn-xs px-file-clear">Clear</button>
                            <!-- <button type="button" class="btn btn-primary btn-xs px-file-browse">Browse</button> -->
                          </div>
                          @if($model->cooperationfile)
                          @foreach($model->cooperationfile as $file)
                            @if ($file->type == 'document') 
                            <a href="{{asset('contents/file/'.$file->filename)}}" target="_blank"><label class="file_{{$file->id}}">{{ $file->filename }}</label> </a>
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
                      @if(count($model->cooperationfile) < 1)
                      <!-- <label class="col-sm-4 control-label">Foto Dokumen Kerjasama :</label>
                      <div class="col-sm-6">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input" name="image">
                          <span class="custom-file-control form-control">
                          Pilih Foto Dokumen...
                          </span>
                          <div class="px-file-buttons">
                            <button type="button" class="btn btn-xs px-file-clear">Clear</button>
                            <button type="button" class="btn btn-primary btn-xs px-file-browse">Browse</button>
                          </div>
                           
                        </label>
                      </div> -->
                      @else
                      <label class="col-sm-4 control-label">Foto Dokumen Kerjasama :</label>
                      <div class="col-sm-8">
                        @if($model->cooperationfile)
                         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tambah Foto</button>
                         <p>&nbsp;</p>

                         @if($model->cooperationfile)

                          <style>
                          table {
                              border-collapse: collapse;
                              width: 100%;
                          }

                          th, td {
                              text-align: left;
                              padding: 8px;
                          }

                          tr:nth-child(even){background-color: #f2f2f2}

                          th {
                              background-color: #3D4A5D;
                              color: white;
                          }
                          </style>
                          <table border="0" cellpadding="1">
                          <tr>
                            <th width="150px">Thumbnail Image</th>
                            <th>Caption</th>
                            <th width="10%">Aksi</th>
                          </tr>
                          @foreach($model->cooperationfoto as $file)
                            <tr>
                                <td>
                                    <img src="{{url('contents/file/'.$file->filename)}}" width="100px" class="file_{{$file->id}}">
                                </td>
                                <td align="left">
                                  {{$file->title}}
                                </td>
                                <td>
                                  <button type="button" class="btn btn-danger px-file-browse deleteFile file_{{$file->id}}" data-id="{{$file->id}}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                          @endforeach
                          </table>
                          @endif 
                        @endif
                      </div>
                      @endif
                    </div>
                  </div>
                  
                 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 1 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('first_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama', $disabled]) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('first_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 2 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('second_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama', $disabled]) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('second_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Penandatangan 3 :</label>
                      <div class="col-sm-4">
                        {!! Form::text('third_sign' , null ,['class' => 'form-control', 'placeholder'=>'Nama', $disabled]) !!}
                      </div>
                      <div class="col-sm-4">
                        {!! Form::text('third_sign_position' , null ,['class' => 'form-control', 'placeholder'=>'Jabatan', $disabled]) !!}
                      </div>
                    </div>
                  </div>
                  @if($status)
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Persetujuan Kerjasama :</label>
                      <div class="col-sm-8">                        
                        
                        {!! Form::select('approval', ['draft'=>'Draft', 'approved'=>'Approved','rejected'=>'Rejected', 'deleted'=>'Deleted'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true, $disabled]) !!} 
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">
                        <button type="submit" class="btn btn-primary btn-3d" {{$disabled}} >Save</button>
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

    <!-- Trigger the modal with a button -->
    

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Foto</h4>
          </div>
          {!! Form::open(['url'=>urlBackendAction('upload-file'), 'class'=>'panel-body p-y-1', 'files'=>true, 'id'=>'myForm', 'method'=>'post']) !!} 
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <label class="col-sm-4 control-label">Judul Gambar :</label>
                <div class="col-sm-8">
                  {!! Form::text('title' , null ,['class' => 'form-control','required'=>'required']) !!}
                </div>
              </div>
            </div>

            <label class="custom-file px-file">
            <input type="file" class="custom-file-input image" name="image" required="required">
            <span class="custom-file-control form-control captionfile">
            Pilih Foto Dokumen...
            </span>
            <em>Please use image in 700px X 525px dimension</em>
            <div class="px-file-buttons">
              {!! Form::hidden('cooperation_id' , isset($model->id) ? $model->id : null) !!}
              <button type="button" class="btn btn-xs px-file-clear">Clear</button>
              <button type="submit" class="btn btn-primary btn-xs px-file-browse uploadimage">Mulai Upload</button>
            </div>
          </div>
          {!! Form::close() !!}
          <div class="modal-footer">
            <button type="button" class="btn btn-default closemodal" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
@endsection

@push('script-js')

<script type="text/javascript" src="assets/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script type="text/javascript">  

    $(function() {

      $(document).on('change', '.image', function(){
        // $('.captionfile').html($(this).val());

          var sizeFile = (this.files[0].size/1024/1024).toFixed(2);
                
          if(sizeFile>0.5){

            alert('This file size is big: ' + (this.files[0].size/1024/1024).toFixed(2) + 'MB');
            $('.captionfile').html('This file size is big: ' + (this.files[0].size/1024/1024).toFixed(2) + 'MB');

              this.value = '';
          }else{
            
            $('.captionfile').html($(this).val());
          
          }
      })

      $(document).on('change', '.file', function(){
        $('.uploadFile').html($(this).val());
      })

      $('input.formid').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
          e.preventDefault();
          return false;
        }
      });
      
      $('#myForm').ajaxForm(function(data) { 
        
        if (data.status == true) {
          alert('Foto berhasil diupload');
        } else {
          alert('Foto gagal diupload');
        }

        location.reload();
      }); 

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