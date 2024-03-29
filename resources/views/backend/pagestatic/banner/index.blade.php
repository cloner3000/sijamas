@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
          
        @include('backend.common.flashes')

        <div class = 'row p-a-3'>
           <div class = 'col-md-12'>

                    {!! trinata::buttonCreate() !!}
                
                
                <p>&nbsp;</p>
                <p>&nbsp;</p>

                <table class = 'table' id = 'table'>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                </table>

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
            $.fn.dataTable.ext.errMode = 'none';
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'brief', name: 'brief' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' , searchable: false, "orderable":false},
                    
                ]
            });
        });

    </script>

@endsection