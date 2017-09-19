@extends('backend.layouts.layout')
@section('content')
 <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Inbox Usulan Kerjasama</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> List Inbox Usulan Kerjasama</div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <ul class="nav nav-tabs">
                    <li>
                      <a href="{{urlBackend('dashboard/index')}}">
                        Inbox Kerjasama
                      </a>
                    </li>
                    <li class="active">
                      <a href="{{urlBackend('dashboard/usulan')}}">
                        Inbox Usulan Kerjasama
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content tab-content-bordered">
                    <div class="tab-pane fade in active" id="tabs-home">
                      
                      <div class="row">
                        <div class="col-md-12 fadeIn animated">
                          <div class="table-secondary">
                            <table class="table table-striped table-bordered" id="datatables">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Pengusul</th>
                                  <th>Pesan</th>
                                  <th>Tanggal Upload</th>
                                  <!-- <th>Approved/Reject</th> -->
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if($model)
                                @foreach($model as $val)
                                <tr class="odd gradeX">
                                  <td>
                                    1
                                  </td>
                                  <td>{{ $val->name }}</td>
                                  <td class="center"><a href="{{ urlBackend('usulan-kerjasama/update/'.$val->id)}}"> {{ $val->message}}</a></td>
                                  <td class="center">{{ \Carbon\Carbon::CreateFromFormat('Y-m-d H:i:s', $val->created_at)->format('j F Y')}}</td>
                                  <!-- <td class="center">
                                    <label for="switcher-rounded" class="switcher switcher-primary">&nbsp;
                                      <input type="checkbox" id="switcher-rounded" class="editData">
                                      <div class="switcher-indicator">
                                        <div class="switcher-yes">Yes</div>
                                        <div class="switcher-no">No</div>
                                      </div>
                                    </label>   
                                  </td> -->
                                  <td class="center">
                                    <a href="{{ urlBackend('usulan-kerjasama/update/'.$val->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i></a> 
                                    <!-- <a href="#" class="btn btn-danger confirm"><i class="fa fa-trash"></i></a>  -->
                                  </td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                            </table>
                          </div>

                          </div>
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
  
  $(document).ready(function() {
    
    $('#datatables').dataTable(); 
    $('a.confirm').on('click',function() {
        swal({
          title: "Batalkan Agenda?",
          text: "Anda tidak akan dapat memulihkan agenda yang sudah dibatalkan",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Batalkan Agenda!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Batal Agenda!", "Agenda Anda telah dibatalkan!", "success");
        });
      });

  });
</script>
@endpush