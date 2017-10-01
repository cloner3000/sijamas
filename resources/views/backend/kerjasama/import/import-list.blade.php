@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }} Import Excel</span>
          </div>   
          
          @include('backend.common.flashes')

        <div class = 'row p-a-3'>
           <div class = 'col-md-12'>

<form id="uploadForm" action="" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
   
      <div class="progress progress active" style="height: 24px">
        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" id="progressbar" style="width: 0%">
          <div id="targetLayer">Process <span id="percentage">0</span>% <span id="status">On Progress</span></div>
        </div>
      </div>

  </div>
  <div class="box-footer">
    <button type="button" class="btn btn-primary" onclick="startTask();" id="saveBtn">Save to database</button>

  </div>
</form>
	

	<div class="box-body" style="overflow: scroll">
          <table>
            <thead>
            <tr>
              <th>No urut</th>
              <th>Judul Kerjasama</th>
              <th>Nomor Kerjasama</th>
              <th>Nama Mitra</th>
              <th>Kategori</th>
              <th>Ruang Lingkup</th>
              <th>Tempat</th>
              <th>Tanggal Mulai</th>
              <th>Tanggal Berakhir</th>
              <th>Nama Penanda tangan Pihak I</th>
              <th>Jabatan Penanda Tangan Pihak I</th>
              <th>Nama Penanda tangan Pihak II</th>
              <th>Jabatan Penanda Tangan Pihak II</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Session::get('preview') as $preview)
            <tr>
              <td>1</td>
              <td>{{$preview['about']}}</td>
              <td>{{$preview['cooperation_number']}}</td>
              <td>{{$preview['partners']}}</td>
              <td>{{$preview['cooperation_category']}}</td>
              <td>{{$preview['scope']}}</td>
              <td>{{$preview['address']}}</td>
              <td>{{$preview['cooperation_signed']}}</td>
              <td>{{$preview['cooperation_ended']}}</td>
              <td>{{$preview['first_sign']}}</td>
              <td>{{$preview['first_sign_position']}}</td>
              <td>{{$preview['second_sign']}}</td>
              <td>{{$preview['second_sign_position']}}</td>
              <td>{{$preview['cooperation_status']}}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
    </div>


            </div>
        </div>      

        </div>
      </div>

    </div>
  </div>
@endsection

@push('script-js')

<script src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript">
     var es;
  
        function startTask() {

            $('#saveBtn').html('please wait...');
            $('#saveBtn').attr('class','btn btn-danger');
            es = new EventSource('{{urlBackend("cooperation-category/progress")}}');
              
            //a message is received
            es.addEventListener('message', function(e) {
                var result = JSON.parse( e.data );
                  
                // addLog(result.message);       
                  
                if(e.lastEventId == 'CLOSE') {
                    addLog('Received CLOSE closing');
                    es.close();
                    // var pBar = document.getElementById('progressor');
                    // pBar.value = pBar.max; //max out the progress bar
                }
                else {
                    // var pBar = document.getElementById('progressor');
                    // pBar.value = result.progress;
                    // var perc = document.getElementById('percentage');
                    // perc.innerHTML   = result.progress  + "%";
                    // perc.style.width = (Math.floor(pBar.clientWidth * (result.progress/100)) + 15) + 'px';
                      $('#progressbar').attr('style','width : '+result.progress+'%');
                      $('span#percentage').html(result.progress);
                      if(result.progress==100){

                      $('#status').html('complete');
                      $('#saveBtn').html('<i class="fa fa-check"></i> successfully');
                      $('#saveBtn').attr('class','btn btn-success');
                      }

                }
            });
              
            es.addEventListener('error', function(e) {
                // addLog('Error occurred');
                es.close();
            });
        }
          
        function stopTask() {
            es.close();
            addLog('Interrupted');
        }
          
        function addLog(message) {
            var r = document.getElementById('results');
            r.innerHTML += message + '<br>';
            r.scrollTop = r.scrollHeight;
        }
        $(function () {
            $('.table-listing').DataTable();

          
               
        });
    </script>
@endpush