@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Kategori Kerjasama</li>
      <li class="active">List</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> List Tindak Lanjut Perencanaan Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12 fadeIn animated">
                
              </div>
              <div class="col-md-7 fadeIn animated">
                {!! Form::open(['class'=>'panel-body p-y-1', 'url'=>urlBackend('cooperation-followup/index'), 'method'=>'get']) !!} 

                  {{--
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Status Data Kerjasama :</label>
                      <div class="col-sm-8">
                        {!! Form::select('approval', [''=>'All Data', 'draft'=>'Draft', 'approved'=>'Approved', 'rejected'=>'Rejected', 'deleted'=>'Deleted'], $request->approval ? $request->approval : null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                      </div>
                    </div>
                  </div>
                  --}}
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategori Kerjasama :</label>
                      <div class="col-sm-8">
                        
                        {!! Form::select('cooperation_category', ['' => 'All Data','dn'=>'Dalam Negeri', 'ln'=>'Luar Negeri'], $request->cooperation_category ? $request->cooperation_category : null ,['class' => 'form-control select2-example', 'style' => 'width: 100%', 'data-allow-clear'=>true]) !!} 
                        
                      </div>
                    </div>
                  </div>
                  <div class="input-daterange" id="datepicker-range">
                    
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-4 control-label">Dari Tanggal :</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                              {!! Form::text('startdate' , $request->startdate ? $request->startdate : null ,['class' => 'form-control']) !!}
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
                              {!! Form::text('enddate' , $request->enddate ? $request->enddate : null ,['class' => 'form-control']) !!}
                              <span class="input-group-btn">
                                <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <div class="col-md-12 fadeIn animated">
               
                <button type="submit" class="btn btn-primary btn-3d"><i class="fa fa-eye"></i>Lihat</button>
                {{--<a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-download"></i> Ekspor</a>--}}
              </div>
              {!! Form::close() !!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 fadeIn animated">
                <div class="table-secondary">
                  <table class="table table-striped table-bordered" id="datatables">
                              <thead>
                                <tr>
                                  <th>Judul</th>
                                  <th>No Kerjasama</th>
                                  <th>Kerjasama Kategori</th>
                                  <th>Kerjasama Status</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
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

@push('script-js')
<script>

  $(document).ready(function() {
    
    $.fn.dataTable.ext.errMode = 'none';
    $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! urlBackendAction($url) !!}',
        columns: [
            { data: 'title', name: 'title' },
            { data: 'cooperation_number', name: 'cooperation_number' },
            { data: 'cooperation_category', name: 'cooperation_category' },
            { data: 'cooperation_status', name: 'cooperation_status' },
            { data: 'approval', name: 'approval' },
            // { data: 'moderation', name: 'moderation' , searchable: false, "orderable":false},
            { data: 'action', name: 'action' , searchable: false, "orderable":false},
            
        ]
    });

    // $('#datatables').dataTable();    
    $('#datepicker-range').datepicker({
      format:'dd/mm/yy'
    });
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
   
    $('a.confirm').on('click',function() {
        swal({
          title: "Hapus Kategori Kerjasama?",
          text: "Anda tidak akan dapat memulihkan Kategori yang sudah dihapus",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Hapus Kategori!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Hapus Kategori!", "Kategori Anda telah dihapus!", "success");
        });
      });
  });

  function moderation(url, id)
  {
    var r = confirm("Press a button!");
    if (r == true) {
        $.ajax({
          type : 'get',
          url : basedomain + url,
          data : {
            id : id,
          },
          success : function(data){
            
          },
        });
    } else {
        return false;
    }
    
  } 

</script>

@endpush