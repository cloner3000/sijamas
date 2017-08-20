@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> Menu</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-6'>

                    @include('backend.common.errors')

                     {!! Form::model($model) !!} 

                      <div class="form-group">
                        <label>Title</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Image File</label>
                          <div>
                            <a class="Wbutton" onclick = "return browseElfinder('image'  , 'image_tempel' , 'elfinder_browse1' , 'cancelBrowse')" >Browse</a>
                            Suggestion Image Size (max. 2MB)
                          </div>
                          <input type = 'hidden' name = 'brief' id = 'image' />
                      </div>
                      
                      <div id="image_tempel" style = 'margin-top:30px;'>
                        @if(!empty($model->image))
                          <img src="{{ asset('contents/banner/thumbnail').'/'.$model->brief }}" width="200" height="200" />
                        @endif
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        {!! Form::select('status' , ['publish' => 'publish' , 'unpublish' => 'unpublish'] , null ,['class' => 'form-control']) !!}
                      </div>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
@endsection