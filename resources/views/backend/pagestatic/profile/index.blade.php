@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
          
          <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Data Company Profile
                    </div>
                    <div class="panel-body">

                        @include('backend.common.errors')

                         {!! Form::model($model,['files' => true]) !!} 

                        {!! Form::hidden('id' , null ,['class' => 'form-control']) !!}
                        
                           <div class="form-group">
                            <label>Title</label>
                            {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                          </div>
                           
                          
                           <div class="form-group">
                            <label>Description</label>
                            {!! Form::textarea('description' , null ,['class' => 'form-control','id'=>'description']) !!}
                          </div>
                          

                          <div class="form-group">

                            <label>&nbsp;</label>
                              <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Create' }}</button>
                          </div>

                        {!! Form::hidden('id' , null ,['class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                    @if(!empty($model->id))
                    
            
                    @endif
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection

@section('script')
    
    <script type="text/javascript">
        
        $(document).ready(function(){

        window.onload = function()
        {
          CKEDITOR.replace( 'description',{
          filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
        }
            $.fn.dataTable.ext.errMode = 'none';
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' , searchable: false, "orderable":false}
                    
                ]
            });
        });

    </script>

@endsection