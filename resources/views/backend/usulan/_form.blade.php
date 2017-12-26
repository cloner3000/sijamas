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

                @include('backend.common.errors')
                {!! Form::model($model,['class'=>'panel-body p-y-1', 'files'=>true]) !!} 

                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Nama Pengusul :</label>
                      <div class="col-sm-8">
                        {!! Form::text('name' , (!empty($model->id)) ? null : \Auth::user()->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Judul Usulan :</label>
                      <div class="col-sm-8">
                        {!! Form::text('title' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Instansi :</label>
                      <div class="col-sm-8">
                        {!! Form::text('institute' , (!empty($model->id)) ? null : 'BSN' ,['class' => 'form-control',  'readonly' => 'readonly']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jabatan :</label>
                      <div class="col-sm-8">
                        {!! Form::text('position' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Alamat :</label>
                      <div class="col-sm-8">
                        {!! Form::textarea('address' , (!empty($model->id)) ? null : \Auth::user()->address ,['class' => 'form-control',  'readonly' => 'readonly']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Telepon * :</label>
                      <div class="col-sm-8">
                        {!! Form::text('phone' , (!empty($model->id)) ? null : \Auth::user()->phone ,['class' => 'form-control', 'onkeypress' => 'return isNumberKey(event)',  'readonly' => 'readonly']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Email * :</label>
                      <div class="col-sm-8">
                        {!! Form::email('email' , (!empty($model->id)) ? null : \Auth::user()->email ,['class' => 'form-control',  'readonly' => 'readonly']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Isi Pesan :</label>
                      <div class="col-sm-8">
                        {!! Form::textarea('message' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jenis Naskah Kerjsama yang Diusulkan :</label>
                      <div class="col-sm-8">
                        @if($data['type'])
                          @foreach($data['type'] as $type)

                          <!-- <div class="radio"> -->
                            <label class="custom-control custom-radio radio-inline">
                                {!! Form::radio('proposed_cooperation_type_id' , $type->id ,null,['class' => 'custom-control-input' , (!empty($model->id)) ? 'disabled' : '']) !!}
                                <span class="custom-control-indicator"></span>
                                {{$type->name}}
                            </label><br/>
                          <!-- </div> -->
                          @endforeach
                        @endif
                        <br/>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Draft File Kerjasama :</label>
                      <div class="col-sm-8">
                        <label class="custom-file px-file">
                          <input type="file" class="custom-file-input" name="filename">
                          <span class="custom-file-control form-control">Choose file...</span>
                          
                          <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear">Clear</button>
                            <button type="button" class="btn btn-primary px-file-browse">Upload</button>
                          </div>

                          @if($model->filename)
                          <a href="{{url('contents/file/'.$model->filename)}}" target="_blank"> {{$model->filename}}</a>
                          @endif
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Persetujuan Usulan Kerjasama :</label>
                      <div class="col-sm-8">                        
                        
                        {!! Form::select('approval', ['draft'=>'Draft', 'approved'=>'Approved', 'rejected'=>'Rejected'], null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">
                        <button type="submit" class="btn btn-primary btn-3d">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                      </label>
                      <div class="col-sm-8">                  
                          &nbsp;
                      </div>
                    </div>
                  </div>
                {!! Form::close() !!}
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
    });
</script>
@endpush