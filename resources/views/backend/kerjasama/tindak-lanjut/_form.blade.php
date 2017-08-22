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
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Implementasi Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-8">
                
                {!! Form::model($model, ['class'=>'panel-body p-y-1', 'files'=>true]) !!} 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Judul Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::select('cooperation_id', $data['cooperation'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tanggal Implementasi :</label>
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
                      <label class="col-sm-4 control-label">Activity :</label>
                      <div class="col-sm-8">
                        {!! Form::textarea('activity_type' , null ,['id' => 'summernote-base']) !!}
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Deskripsi :</label>
                      <div class="col-sm-8">
                          <div class="input-group">
                            {!! Form::text('description' , isset($model->description) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->description)->format('d/m/Y') : null ,['class' => 'form-control datepicker']) !!}
                            <span class="input-group-btn">
                              <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                            </span>
                          </div>
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