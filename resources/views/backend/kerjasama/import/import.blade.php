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
				<form method="post" action="" enctype="multipart/form-data">		
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				    
					<div class="form-group">
					  <label for="exampleInputFile">File input Excel</label>

					  <label class="custom-file px-file" for="success-input-4">
					  <input type="file" class="custom-file-input" id="success-input-4" name="file" required="required">

		                <span class="custom-file-control form-control">Choose file...</span>
		            
		              </label>
					  <p class="help-block">Only File Excel</p>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-success">Preview List Excel</button>
					</div>
				</form>
            </div>
        </div>      

        </div>
      </div>

    </div>
  </div>
@endsection