@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Kategory Kerjasama</li>
      <li class="active">List</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> List Kategory Kerjasama</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-12 fadeIn animated">
                <a href="{{ urlBackend('kategori-kerjasama/create')}}" class="btn btn-info btn-3d"> <i class="fa fa-plus"></i> Tambah</a> 
              </div>
              <div class="col-md-7 fadeIn animated">
                <form action="#" method="post" class="panel-body p-y-1">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Status Data Kerjasama :</label>
                      <div class="col-sm-8">
                        <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                          <option>Pilih Status Data</option>
                          <option value="AK">Approved</option>
                          <option value="AK">Reject</option>
                          <option value="AK">Draft</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Kategory Kerjasama :</label>
                      <div class="col-sm-8">
                        <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                          <option>Pilih Kategory Kerjasama</option>
                          <option value="AK">Dalam Negeri</option>
                          <option value="AK">Luar Negeri</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="input-daterange" id="datepicker-range">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-4 control-label">Dari Tanggal :</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                              <input type="text" class="form-control" name="start">
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
                              <input type="text" class="form-control" name="end">
                              <span class="input-group-btn">
                                <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                              </span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <div class="col-md-12 fadeIn animated">
                <a href="tambah-event-calendar.php" class="btn btn-primary btn-3d"> <i class="fa fa-eye"></i> Lihat</a> <a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-download"></i> Ekspor</a>
              </div>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 fadeIn animated">
                <div class="table-secondary">
                  <table class="table table-striped table-bordered" id="datatables">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Jenis Data</th>
                                  <th>Judul</th>
                                  <th>Tanggal Upload</th>
                                  <th>Approved/Reject</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="odd gradeX">
                                  <td>
                                    1
                                  </td>
                                  <td>Kerjasama Luar Negeri</td>
                                  <td class="center"><a href="{{ urlBackend('kategori-kerjasama/update')}}"> Mou BSN - BNSP; Perkuat Personel Indonesia Hadapi MEA</a></td>
                                  <td class="center">12-02-2017</td>
                                  <td class="center">
                                    <label for="switcher-rounded" class="switcher switcher-primary">&nbsp;
                                      <input type="checkbox" id="switcher-rounded" class="editData">
                                      <div class="switcher-indicator">
                                        <div class="switcher-yes">Yes</div>
                                        <div class="switcher-no">No</div>
                                      </div>
                                    </label>   
                                  </td>
                                  <td class="center">
                                    <a href="{{ urlBackend('kategori-kerjasama/update')}}" class="btn btn-success"><i class="fa fa-pencil"></i></a> 
                                    <a href="#" class="btn btn-danger confirm"><i class="fa fa-trash"></i></a> 
                                  </td>
                                </tr>
                                
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
    
    $('#datatables').dataTable();    
    $('#datepicker-range').datepicker();
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
   
    $('a.confirm').on('click',function() {
        swal({
          title: "Hapus Kategory Kerjasama?",
          text: "Anda tidak akan dapat memulihkan Kategory yang sudah dihapus",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Hapus Kategory!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Hapus Kategory!", "Kategory Anda telah dihapus!", "success");
        });
      });
  });

</script>
@endpush