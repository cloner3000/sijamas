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
                        <label>Judul</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Nomor Kerjasama</label>
                        {!! Form::text('cooperation_number' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Kategori Kerjasama</label>
                        {!! Form::select('cooperation_category' ,['dn'=>'Dalam Negeri', 'ln'=>'Luar Negeri'], null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Kategori Status Kerjasama</label>
                        {!! Form::select('cooperation_status' , ['baru'=>'Baru', 'lanjutan'=>'Lanjutan'], null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Jenis Kerjasama</label>
                        {!! Form::select('cooperation_type_id' , $data['cooperationType'], null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Tentang Kerjasama</label>
                        {!! Form::text('about' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Mitra Kerjasama</label>
                        {!! Form::text('partners' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Kerjasama</label>
                        {!! Form::select('cooperation_province_id', $data['province'], null ,['class' => 'form-control']) !!}
                        {!! Form::select('cooperation_city_id' , $data['city'], null ,['class' => 'form-control']) !!}
                        {!! Form::text('address' , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Dari Tanggal</label>
                        {!! Form::text('cooperation_signed' , isset($model->cooperation_signed) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_signed)->format('d/m/Y') : null ,['class' => 'form-control datepicker']) !!}
                      </div>
                      <div class="form-group">
                        <label>Sampai Tanggal</label>
                        {!! Form::text('cooperation_ended' , isset($model->cooperation_ended) ? \Carbon\Carbon::createFromFormat('Y-m-d', $model->cooperation_ended)->format('d/m/Y') : null ,['class' => 'form-control datepicker']) !!}
                      </div>
                      <div class="form-group">
                        <label>Bidang Fokus</label>
                        {!! Form::select('cooperation_focus_id', $data['cooperationFocus'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Ruang Lingkup</label>
                        {!! Form::text('scope' , null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Persetujuan Kerjasama</label>
                        {!! Form::select('approval' ,['draft'=>'Draft', 'approved'=>'Approved', 'rejected'=>'Rejected', 'deleted'=>'Deleted'], null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
@endsection

@section('script')
    
    <script type="text/javascript">
        
        $('.datepicker').datepicker({
          dateFormat:'dd/mm/yy'
        })

    </script>

@endsection