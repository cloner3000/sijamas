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
                       Data Social Media
                    </div>
                    <div class="panel-body">

                        @include('backend.common.errors')

                         {!! Form::model($model,['files' => true]) !!} 

                        {!! Form::hidden('id' , null ,['class' => 'form-control']) !!}
                        
                           <div class="form-group">
                            <label>Facebook</label>
                            {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                          </div>

                          <div class="form-group">
                            <label>Twitter</label>
                            {!! Form::text('brief' , null ,['class' => 'form-control']) !!}
                          </div>
                           
                          
                           <div class="form-group">
                            <label>Youtube</label>
                            {!! Form::text('description' , null ,['class' => 'form-control']) !!}
                          </div>

                          <div class="form-group">
                            <label>Instagram</label>
                            {!! Form::text('image' , null ,['class' => 'form-control']) !!}
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

@push('script-js')
    
    <script type="text/javascript">
        
        $(document).ready(function(){

        
            $.fn.dataTable.ext.errMode = 'none';
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'brief', name: 'brief' },
                    { data: 'description', name: 'description' },
                    { data: 'image', name: 'image' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' , searchable: false, "orderable":false}
                    
                ]
            });
        });

    </script>

@endpush