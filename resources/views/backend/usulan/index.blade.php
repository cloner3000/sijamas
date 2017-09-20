@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Usulan Kerjasama</li>
      <li class="active">List</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> List Usulan Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12 fadeIn animated">
                <a href="{{ urlBackend('usulan-kerjasama/create')}}" class="btn btn-info btn-3d"> <i class="fa fa-plus"></i> Tambah</a> 
              </div>
              <div class="col-md-7 fadeIn animated">
                {!! Form::open(['class'=>'panel-body p-y-1', 'url'=>urlBackend('usulan-kerjasama/index'), 'method'=>'get']) !!} 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Status Data :</label>
                      <div class="col-sm-8">
                        
                          {!! Form::select('approval' , ['', 'approved'=>'Approved', 'draft'=>'Draft'], $request->approval ? $request->approval : null ,['class' => 'form-control select2-example', 'style'=>'width:100%', 'data-allow-clear'=>true]) !!}
                        
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
                <button type="submit" class="btn btn-primary btn-3d"><i class="fa fa-eye"></i> Lihat</button>

                <a href="{{urlBackend('usulan-kerjasama/export-excel')}}" class="btn btn-danger btn-3d"> <i class="fa fa-download"></i> Ekspor</a>
                <!-- <a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-download"></i> Ekspor</a> -->
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
                                  <th>Nama</th>
                                  <th>Judul Usulan</th>
                                  <th>Status</th>
                                  <th>Tanggal Upload</th>
                                  <!-- <th>Approved/Reject</th> -->
                                  <th>Aksi</th>
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

<script>

  $(document).ready(function() {
    
    $.fn.dataTable.ext.errMode = 'none';
    $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! urlBackendAction($url) !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'title', name: 'title' },
            { data: 'approval', name: 'approval' },
            { data: 'created_at', name: 'created_at' },
            // { data: 'moderation', name: 'moderation' , searchable: false, "orderable":false},
            { data: 'action', name: 'action' , searchable: false, "orderable":false},
            
        ]
    });

    $('#datatables').dataTable();    
    $('#datepicker-range').datepicker();
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
   
    $('a.confirm').on('click',function() {
        swal({
          title: "Hapus Usulan?",
          text: "Anda tidak akan dapat memulihkan Usulan yang sudah dihapus",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Hapus Usulan!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Hapus Usulan!", "Usulan Anda telah dihapus!", "success");
        });
      });
  });

</script>
@endpush