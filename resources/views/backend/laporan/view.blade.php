@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i> Preview Data Custom Report</span>
          </div>   
                    
            <div class="row p-a-3">
                <a href="{{urlBackend(Request::segment(1).'/export?start='.$start.'&end='.$end.'&report='.$field)}}" class="btn btn-primary btn-3d"><i class="fa fa-file-excel-o"></i> Eksport Report</a>
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach($dataField as $column)
                                <th>{{$column['name']}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
            $("#table").DataTable({
                ordering :false,
            });
        });
    </script>

@endpush