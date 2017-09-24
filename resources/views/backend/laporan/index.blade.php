@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Laporan</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> Custom Ekspor Report</div>
              </div>
              <div class="panel-body">
               {!! Form::model($model) !!} 
               <div class="row" >
               <div class="input-daterange" id="datepicker-range">
                 <div class="col-md-3">                                      
                   <div class="form-group">
                      <label class="control-label">Dari Tanggal :</label>
                      <div class="input-group">
                          <input type="text" class="form-control tanggal"  name="start" id="datepicker" required="required">
                          <span class="input-group-btn">
                            <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                          </span>
                      </div>
                    </div>
                   </div>
                   <div class="col-md-3">   
                      <div class="form-group">
                        <label class="control-label">Sampai Tanggal :</label>
                        <div class="input-group">
                            <input type="text" class="form-control tanggal"  name="end" id="datepicker2" required="required">
                            <span class="input-group-btn">
                              <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>   
                        </div>
                    </div>
                   <div class="col-md-3">   
                   <div class="form-group">
                        <label class="control-label">Jenis Kerjasama :</label>
                        <select class="form-control" name="category">
                              <option value="">Semua Jenis Kerjasama</option>
                              <option value="dn">Dalam Negeri</option>
                              <option value="ln">Luar Negeri</option>
                        </select>
                      </div>
                    </div>
                   <div class="col-md-3">   
                   <div class="form-group">
                        <label class="control-label">Lokasi Provinsi :</label>
                        <select class="form-control" name="province">
                          <option value="">Semua Provinsi</option>

                          @foreach($province as $key=>$propinsi)
                          <option value="{{$key}}">{{$propinsi}}</option>
                          @endforeach
                        </select>
                       
                    </div>
                    </div>
                 </div>
                 </div>
               <div class="row">
                <div class="col-xs-5">
                    <select name="from[]" id="multiselect" class="form-control" size="13" multiple="multiple">
                        <option value="2">Kategori</option>
                        <option value="3">Status</option>
                        <option value="4">Jenis Kerjasama</option>
                        <option value="5">Judul Kerja Sama</option>
                        <option value="6">Nama Mitra</option>
                        <option value="7">Bidang Fokus</option>
                        <option value="8">Ruang Lingkup</option>
                        <option value="9">Nomor Kerja Sama</option>
                        <option value="10">Province</option>
                        <option value="11">Nama Penanda Tangan Pihak I</option>
                        <option value="12">Jabatan Penanda Tangan Pihak I</option>
                        <option value="13">Nama Penanda Tangan Pihak II</option>
                        <option value="14">Jabatan Penanda Tangan Pihak II</option>
                    </select>
                </div>
                
                <div class="col-xs-2">
                    <button type="button" id="multiselect_undo" class="btn btn-primary btn-block">undo</button>
                    <button type="button" id="multiselect_rightSelected" class="btn btn-default btn-block"><i class="fa fa-forward"></i></button>
                    <button type="button" id="multiselect_leftSelected" class="btn btn-default btn-block"><i class="fa fa-backward"></i></button>
                    <button type="button" id="multiselect_redo" class="btn btn-warning btn-block">redo</button>
                </div>
                
                <div class="col-xs-5">
                    <select name="to[]" id="multiselect_to" class="form-control" size="13" multiple="multiple">                      
                        <option value="1" selected="selected">Nomor Kerjasama</option>
                    </select>
                     <div class="row">
                        <div class="col-sm-6">
                            <button type="button" id="multiselect_move_up" class="btn btn-block"><i class="fa fa-arrow-up"></i></button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" id="multiselect_move_down" class="btn btn-block col-sm-6"><i class="fa fa-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-y-3">
              <div class="col-sm-8">                
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-12 control-label">
                        <button type="submit" class="btn btn-info btn-3d">Preview Report</button>
                        <!-- <button type="button" class="btn btn-primary btn-3d">Eksport Report</button> -->
                        <button type="reset" class="btn btn-deafult btn-3d">Cancel</button>
                      </label>
                    </div>
                  </div>
              </div>
            </div>
               {!! Form::close() !!} 
              </div>
            </div>
    </div>


@endsection

@push('script-js')

<script type="text/javascript" src="{{ asset(null) }}backend/assets/js/multiselect.min.js"></script>
<script type="text/javascript">  
$(document).ready(function() {

    $('#datepicker-range').datepicker({format : 'dd/mm/yyyy'});

    $('#multiselect').multiselect({
        oneOrMoreSelected: '*',
        selectAll: false,
        noneSelected: 'Check some languages!'
    }, function(objCheckbox) {
        if (jQuery(objCheckbox).val() == "1") {
            jQuery(objCheckbox).attr("checked", "checked");
        }
    });
});
</script>
@endpush