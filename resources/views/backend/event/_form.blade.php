@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-plus"></i> {{ trinata::titleActionForm() }}</div>
          </div>
          <div class="panel-body">
          <div class="row">
          <div class="col-md-7">
            @include('backend.common.errors')

                     {!! Form::model($model,['files' => true]) !!} 

                      <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('name' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Start Date</label>
                        {!! Form::text('start_date' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>End Date</label>
                        {!! Form::text('end_date' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Location</label>
                        {!! Form::textarea('location' , null ,['class' => 'form-control','id'=>'description']) !!}
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        {!! Form::select('status' , ['pending' => 'pending' , 'active' => 'active'] , null ,['class' => 'form-control']) !!}
                      </div>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('script-js')
<script type="text/javascript">
  
  window.onload = function()
  {
      CKEDITOR.replace( 'description',{
      filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
  }
</script>
@endpush