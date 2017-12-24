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
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Perencanaan Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-8">
                
                {!! Form::model($model, ['class'=>'panel-body p-y-1', 'files'=>true]) !!} 
                  
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tanggal Perencanaan :</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            {!! Form::text('implementation_date' , isset($model->implementation_date) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->implementation_date)->format('d/m/Y') : null ,['class' => 'form-control datepicker']) !!}
                            <span class="input-group-btn">
                              <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                            </span>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jenis Kegiatan :</label>
                      <div class="col-sm-8">
                        {!! Form::text('activity_type' , null ,['id' => 'summernote-base1', 'class'=>'form-control']) !!}
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Keterangan :</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            {!! Form::textarea('description' , isset($model->description) ? $model->description : null ,['class' => 'form-control', 'id' => 'summernote-base']) !!}
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Foto :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input" name="image">
                          <span class="custom-file-control form-control">
                          Pilih Foto ...
                          </span>
                          <em>Please use image in 700px X 525px dimension</em>
                          <!-- <div class="px-file-buttons">
                            <button type="button" class="btn btn-xs px-file-clear">Clear</button>
                            <button type="button" class="btn btn-primary btn-xs px-file-browse">Browse</button>
                          </div> -->
                          @if($model->image)
                            <img src="{{ url('contents/file/'.$model->image)}}" width="300px">
                          @endif 
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
                  {!! Form::hidden('id' , null) !!}
                  {!! Form::hidden('cooperation_id' , isset($cooperation_id) ? $cooperation_id : null) !!}

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
        format:'dd/mm/yyyy'
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
</script>
@endpush