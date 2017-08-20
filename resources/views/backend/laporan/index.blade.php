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
               <div class="row">
                <div class="col-xs-5"> 
                    <div class="row">
                        <div class="col-sm-12">                          
                           <div class="form-group">
                            <div class="row">
                              <label class="col-sm-4 control-label">Dari Tanggal :</label>
                              <div class="col-sm-8"> 
                                  <div class="input-group">
                                    <input type="text" class="form-control tanggal" name="date" id="datepicker">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                                    </span>
                                  </div>
                              </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <select name="from[]" id="undo_redo" class="form-control" size="13" multiple="multiple">
                        <option value="1">C++</option>
                        <option value="2">C#</option>
                        <option value="3">Haskell</option>
                        <option value="4">Java</option>
                        <option value="5">JavaScript</option>
                        <option value="6">Lisp</option>
                        <option value="7">Lua</option>
                        <option value="8">MATLAB</option>
                        <option value="9">NewLISP</option>
                        <option value="10">PHP</option>
                        <option value="11">Perl</option>
                        <option value="12">SQL</option>
                        <option value="13">Unix shell</option>
                    </select>
                </div>
                
                <div class="col-xs-2">
                    <button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>
                    <button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block"><i class="fa fa-forward"></i></button>
                    <button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block"><i class="fa fa-backward"></i></button>
                    <button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>
                </div>
                
                <div class="col-xs-5">
                    <div class="row">
                        <div class="col-sm-12">                          
                           <div class="form-group">
                            <div class="row">
                              <label class="col-sm-4 control-label">Sampai Tanggal :</label>
                              <div class="col-sm-8"> 
                                  <div class="input-group">
                                    <input type="text" class="form-control tanggal" name="date" id="datepicker2">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                                    </span>
                                  </div>
                              </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <select name="to[]" id="undo_redo_to" class="form-control" size="13" multiple="multiple"></select>
                </div>
            </div>
            <div class="row p-y-3">
              <div class="col-sm-8">                
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-12 control-label">
                        <button type="submit" class="btn btn-info btn-3d">Preview Report</button>
                        <button type="submit" class="btn btn-primary btn-3d">Eksport Report</button>
                        <button type="submit" class="btn btn-deafult btn-3d">Cancel</button>
                      </label>
                    </div>
                  </div>
              </div>
            </div>
              </div>
            </div>
    </div>


@endsection

@push('script-js')

<script type="text/javascript" src="assets/js/multiselect.min.js"></script>
<script type="text/javascript">  
$(document).ready(function() {

    $('#datepicker').datepicker();
    $('#datepicker2').datepicker();
    $('#undo_redo').multiselect();
});
</script>
@endpush