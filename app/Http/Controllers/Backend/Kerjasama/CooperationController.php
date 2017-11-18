<?php namespace App\Http\Controllers\Backend\Kerjasama;

/**
 * Sample Crud
 */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Cooperation;
use App\Models\CooperationType;
use App\Models\CooperationFocus;
use App\Models\CooperationProvince;
use App\Models\CooperationCity;
use App\Models\CooperationFile;
use Table;
use Image;
use trinata;
use Session;
use Carbon\Carbon;

class CooperationController extends TrinataController
{
    public function __construct(Cooperation $model)
    {
    	parent::__construct();

    	$this->model = $model;
    }

    public function getData(Request $request)
    {
        // dd($request->all());
    	$model = $this->model->select('id','title','cooperation_number','cooperation_category','cooperation_status', 'approval');
        if (\Auth::user()->role_id != 1) $model->whereOwnerId(\Auth::user()->id);
        
        if ($request->approval) $model->where('approval', $request->approval);
        if ($request->cooperation_category) $model->where('cooperation_category', $request->cooperation_category);
        if ($request->startdate || $request->enddate) {
            // dd($request->start);
            $start = ($request->startdate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->startdate)->format('Y-m-d') : date('Y-m-d');
            $end = ($request->enddate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->enddate)->format('Y-m-d') : date('Y-m-d');
            // dd($start, $end);
            $model = $model->whereBetween('cooperation_signed',[$start, $end]);
            // if ($request->end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $request->end)->format('Y-m-d'));
        }
        // dd($start, $end,$model->toSql());
    	$data = Table::of($model)
    		->addColumn('moderation',function($model){
                $status = true;
                return trinata::buttonApprove($model->id, $status);
            })
    		->addColumn('action',function($model){
                $status = true;
    			return trinata::buttons($model->id , [] , $status);
    		})
    		
    		->make(true);

    	return $data;
    }

    public function getIndex(Request $request)
    {
        $param = [];
        $url = 'data';
        $parameter = 'export-excel';
        $model = $this->model;

        if ($request->approval) $param[] = 'approval='.$request->approval;
        if ($request->cooperation_category) $param[] = 'cooperation_category='.$request->cooperation_category;
        if ($request->startdate) $param[] = 'startdate='.$request->startdate;
        if ($request->enddate) $param[] = 'enddate='.$request->enddate;
        // dd($model);
        if (count($param) > 0) {
            $url = $url.'?'.implode('&', $param);
            $parameter = $parameter.'?'.implode('&', $param);
        }
        // dd($url);
    	return view('backend.kerjasama.daftar.index', compact('model', 'url', 'request','parameter'));
    }

    public function getCreate()
    {
    	$model = $this->model;
        $data = [
                    'cooperationType' => CooperationType::lists('name','id'),
                    'cooperationFocus' => CooperationFocus::lists('name','id'),
                    'province' => CooperationProvince::lists('name','id'),
                    'city' => [],
                ];
        
        // dd($cooperationType);
    	return view('backend.kerjasama.daftar._form',compact('model', 'data'));
    }

    public function handleUpload($request,$model)
    {
       $image = $request->file('image');

        if(!empty($image))
        {
             if(!empty($model->image))
                {
                    @unlink(public_path('contents/'.$model->image));
                }

            $imageName = randomImage().'.'.$image->getClientOriginalExtension();

            Image::make($image)->save(public_path('contents/'.$imageName));

            return $imageName;
        }else{

            return $model->image;
        }
    }

    public function postCreate(Request $request)
    {
        $model = $this->model;

        $inputs = $request->except('file', 'image');
        $inputsCoop = $request->all();

        $inputs['cooperation_signed'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $inputs['cooperation_ended'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        $inputs['owner_id'] = \Auth::user()->id;
        $inputs['slug'] = str_slug($request->title);
        
        
        $lastId = $model->create($inputs); 
        
        if (isset($inputsCoop['file'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $lastId->id;
            $repo->filename = trinata::globalUpload($request, 'file')['filename'];
            $repo->type = 'document';

            $repo->save();
        } 

        if (isset($inputsCoop['image'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $lastId->id;
            $repo->filename = trinata::globalUpload($request, 'image')['filename'];
            $repo->type = 'photo';

            $repo->save();
        } 

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data = [
                    'cooperationType' => CooperationType::lists('name','id'),
                    'cooperationFocus' => CooperationFocus::lists('name','id'),
                    'province' => CooperationProvince::lists('name','id'),
                    'city' => CooperationCity::where('cooperation_province_id', $model->cooperation_province_id)->lists('name','id'),
                ];

        return view('backend.kerjasama.daftar._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($request->id);


        $inputs = $request->all();
        $model->title = $request->title;
        $model->slug = str_slug($request->title);
        $model->cooperation_number = $request->cooperation_number;
        $model->cooperation_category = $request->cooperation_category;
        $model->cooperation_status = $request->cooperation_status;
        $model->cooperation_type_id = $request->cooperation_type_id;
        $model->about = $request->about;
        $model->partners = $request->partners;
        $model->cooperation_province_id = $request->cooperation_province_id;
        $model->cooperation_city_id = $request->cooperation_city_id;
        $model->address = $request->address;
        $model->address = $request->address;
        if (strlen (strtotime($request->cooperation_signed)) < 10 || strlen (strtotime($request->cooperation_ended)) < 10) {
            return redirect(urlBackendAction('update/'.$id))->withInfo('Format Tanggal tidak valid');
        } 
        $model->cooperation_signed = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $model->cooperation_ended = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        $model->cooperation_focus_id = $request->cooperation_focus_id;
        $model->scope = $request->scope;
        $model->approval = $request->approval;
        $model->save(); 
        
        if (isset($inputs['file'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $model->id;
            $repo->filename = trinata::globalUpload($request, 'file')['filename'];
            $repo->type = 'document';

            $repo->save();
        } 

        if (isset($inputs['image'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $model->id;
            $repo->filename = trinata::globalUpload($request, 'image')['filename'];
            $repo->type = 'photo';

            $repo->save();
        } 

        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
            $repo = CooperationFile::whereCooperationId($model->id);
            if ($repo) {
                foreach ($repo as $key => $value) {
                    @unlink(public_path('contents/'.$value->filename));
                }
            }
            
            $model->delete();
            return redirect(urlBackendAction('index'))->withSuccess('data has been deleted');
        
        }catch(\Exception $e){
        
            return redirect(urlBackendAction('index'))->withInfo('data cannot be deleted');
        }
    }

    public function getPublish($id)
    {
        $model = $this->model->findOrFail($id);

        if($model->status == 'y')
        {
            $status = 'n';
            $msg = 'Data has been Published';
        
        }else{
            $status = 'y';
            $msg = 'Data has been UnPublished';
        }

        $model->update([
            'status' => $status,
        ]);

        return redirect(urlBackendAction('index'))->withSuccess($msg);
    }

    public function getDeleteFile(Request $request)
    {
        $status = false;
        $model = CooperationFile::findOrFail($request->id);
        try
        {
            $model->delete();
            $status = true;    
        }catch(\Exception $e){
        
        
        }

        return response()->json(['status' => $status]);
    }

    public function postUploadFile(Request $request)
    {
        $inputs = $request->all();
        $model = $this->model->findOrFail($request->cooperation_id);

        $status= false;
        if (isset($inputs['image']) && $model->id) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $model->id;
            $repo->filename = trinata::globalUpload($request, 'image')['filename'];
            $repo->type = 'photo';
            $repo->title = $inputs['title'];

            $repo->save();
            
            $status= true;
        }

        return response()->json(['status' => $status]);
    }

    public function getCity(Request $request)
    {
        $status = false;
        $model = CooperationCity::where('cooperation_province_id', $request->id)->lists('name', 'id');
        if ($model) $status = true;

        return response()->json(['status' => $status, 'res'=>$model]);
    }

    public function getExportExcel(Request $request)
    {
        $data= [];

        $model = $this->model;
        if (\Auth::user()->role_id != 1) $model->whereOwnerId(\Auth::user()->id);
        
        if ($request->approval) $model = $model->where('approval', $request->approval);
        if ($request->cooperation_category)  $model = $model->where('cooperation_category', $request->cooperation_category);
        if ($request->startdate || $request->enddate) {
            // dd($request->start);
            $start = ($request->startdate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->startdate)->format('Y-m-d') : date('Y-m-d');
            $end = ($request->enddate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->enddate)->format('Y-m-d') : date('Y-m-d');
            // dd($start, $end);
            $model = $model->whereBetween('cooperation_signed',[$start, $end]);
            // if ($request->end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $request->end)->format('Y-m-d'));
        }
        
        $model = $model->orderBy('id','asc')->get();

        foreach ($model as $key => $value) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d', $value->cooperation_signed);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d', $value->cooperation_ended);
            $diff_in_months = $to->diffInMonths($from);
            $diff_in_years = $to->diffInYears($from);
            // dd($diff_in_years); // Output: 1
            $city = $value->city()->first()->name;
            $province = $value->province()->first()->name;

            $data[$key]['No.Urut'] = $key+1;
            $data[$key]['Judul Kerja Sama'] = $value->about;
            $data[$key]['Nomor Kerja Sama'] = $value->cooperation_number ;
            $data[$key]['Kata Kunci Pencarian'] = 'Standardisasi dan Penilaian Kesesuaian' ;
            $data[$key]['Nama Mitra'] = $value->partners;
            $data[$key]['Kategori'] = strtoupper($value->cooperation_category) ;
            $data[$key]['Unit Kerja Terkait'] = 'BSN' ;
            $data[$key]['Ruang Lingkup'] = strip_tags($value->scope) ;
            $data[$key]['Fokus Bidang'] = '-' ;
            $data[$key]['Fokus Bidang Lainnya'] = 'Standardisasi dan Penilaian Kesesuaian' ;
            $data[$key]['Tempat'] = $city.", ".$province ;
            $data[$key]['Tanggal Mulai'] = $value->cooperation_signed ;
            $data[$key]['Tanggal Berakhir'] = $value->cooperation_ended ;
            $data[$key]['Lamanya [Bulan]'] = $diff_in_months ;
            $data[$key]['Lamanya [Tahun]'] = $diff_in_years ;
            $data[$key]['Nama Penanda Tangan Pihak I'] = $value->first_sign ;
            $data[$key]['Jabatan Penanda Tangan Pihak I'] = $value->first_sign_position ;
            $data[$key]['Nama Penanda Tangan Pihak II'] = $value->second_sign ;
            $data[$key]['Jabatan Penanda Tangan Pihak II'] = $value->second_sign_position ;
            $data[$key]['Status'] = ucfirst($value->cooperation_status) ;
            $data[$key]['Alamat Dokumen'] = 'BSN' ;
        }

        \Excel::create('Kategori-Kerjasama', function($excel)  use($data) {

            $excel->sheet('Sheet Name', function($sheet) use($data)  {

                $sheet->fromArray($data);
            
            });
        })->download('xlsx');
    }

    public function getReadExcel()
    {
        # code...
                dd('#code');
        $model = $this->model;


        $pathFile = public_path().'/data/listmou.xlsx';

        
        $dataexcel = \Excel::load($pathFile, function($reader) {
            // reader methods
        })->get();
        // dd($dataexcel->first()->toArray());
        foreach ($dataexcel->first()->toArray() as $key => $value) {
            # code...
            if(!empty($value['nourut'])){

                if(!empty($value['tanggal_berakhir'])){
                    if($value['nomor_kerja_sama']=="510/012/INDAG/2013"){
                            $cooperation_ended = "2018-10-17";

                    }else{
                            $cooperation_ended = $value['tanggal_berakhir'];

                    }
                }else{
                    $cooperation_ended = '0000-00-00';
                }
                if(!empty($value['tanggal_mulai'])){
                    $cooperation_signed = $value['tanggal_mulai'];
                }else{
                    $cooperation_signed = '0000-00-00';
                }
 
                if(!empty($value['nomor_kerja_sama'])){
                    $nomor_kerja_sama = $value['nomor_kerja_sama'];
                }else{
                    $nomor_kerja_sama = 'MOU/09/2017/'.$key.'/TEMP';
                }

                if(!empty($value['judul_kerja_sama'])){
                    $judul_kerja_sama = $value['judul_kerja_sama'];
                }else{
                    $judul_kerja_sama = '-';
                }
                if(!empty($value['ruang_lingkup'])){
                    $scope = $value['ruang_lingkup'];
                }else{
                    $scope = '-';
                }
                if(!empty($value['tempat'])){
                    $address = $value['tempat'];
                }else{
                    $address = '-';
                }
                

                $kat = explode('-', $value['kategori']);
                $data[$key]['title'] =$judul_kerja_sama;
                $data[$key]['about'] =$judul_kerja_sama;
                $data[$key]['cooperation_number'] =$nomor_kerja_sama;
                $data[$key]['partners'] =$value['nama_mitra'];
                $data[$key]['cooperation_category'] = strtolower($kat[0]);
                $data[$key]['scope'] =$scope;
                $data[$key]['address'] =$address;
                $data[$key]['cooperation_signed'] =$cooperation_signed;
                $data[$key]['cooperation_ended'] = $cooperation_ended;
                $data[$key]['first_sign'] =$value['nama_penanda_tangan_pihak_i'];
                $data[$key]['first_sign_position'] =$value['jabatan_penanda_tangan_pihak_i'];
                $data[$key]['second_sign'] =$value['nama_penanda_tangan_pihak_ii'];
                $data[$key]['second_sign_position'] =$value['jabatan_penanda_tangan_pihak_ii'];
                $data[$key]['cooperation_status'] = strtolower($value['status']);
                $data[$key]['cooperation_focus_id'] = 2;
                $data[$key]['cooperation_type_id'] = 2;
                $data[$key]['cooperation_province_id'] = 1;
                $data[$key]['cooperation_city_id'] = 1;
                $data[$key]['owner_id'] = 6;

                
                $model->create($data[$key]); 
            }
        }

        print_r($data);
        dd($data,'success');
    }

    public function getImport()
    {

        // $this->layout->{'rightSection'} = view('custom.import');
        return view('backend.kerjasama.import.import');
    }
    public function postImport(Request $request)
    {
        $inputs = $request->all();
// dd($inputs['file']);
        $data = [];
        $dataexcel = \Excel::load($inputs['file'], function($reader) {

        })->get();

        foreach ($dataexcel->first()->toArray() as $key => $value) {
            # code...
            if(!empty($value['nourut'])){

                if(!empty($value['tanggal_berakhir'])){
                    if($value['nomor_kerja_sama']=="510/012/INDAG/2013"){
                            $cooperation_ended = "2018-10-17";

                    }else{
                            $cooperation_ended = $value['tanggal_berakhir'];

                    }
                }else{
                    $cooperation_ended = '0000-00-00';
                }
                if(!empty($value['tanggal_mulai'])){
                    $cooperation_signed = $value['tanggal_mulai'];
                }else{
                    $cooperation_signed = '0000-00-00';
                }
 
                if(!empty($value['nomor_kerja_sama'])){
                    $nomor_kerja_sama = $value['nomor_kerja_sama'];
                }else{
                    $nomor_kerja_sama = 'MOU/10/2017/'.$key.'/TEMP';
                }

                if(!empty($value['judul_kerja_sama'])){
                    $judul_kerja_sama = $value['judul_kerja_sama'];
                }else{
                    $judul_kerja_sama = '-';
                }
                if(!empty($value['ruang_lingkup'])){
                    $scope = $value['ruang_lingkup'];
                }else{
                    $scope = '-';
                }
                if(!empty($value['tempat'])){
                    $address = $value['tempat'];
                }else{
                    $address = '-';
                }
                

                $kat = explode('-', $value['kategori']);
                $data[$key]['title'] =$judul_kerja_sama;
                $data[$key]['about'] =$judul_kerja_sama;
                $data[$key]['cooperation_number'] =$nomor_kerja_sama;
                $data[$key]['partners'] =$value['nama_mitra'];
                $data[$key]['cooperation_category'] = strtolower($kat[0]);
                $data[$key]['scope'] =$scope;
                $data[$key]['address'] =$address;
                $data[$key]['cooperation_signed'] =$cooperation_signed;
                $data[$key]['cooperation_ended'] = $cooperation_ended;
                $data[$key]['first_sign'] =$value['nama_penanda_tangan_pihak_i'];
                $data[$key]['first_sign_position'] =$value['jabatan_penanda_tangan_pihak_i'];
                $data[$key]['second_sign'] =$value['nama_penanda_tangan_pihak_ii'];
                $data[$key]['second_sign_position'] =$value['jabatan_penanda_tangan_pihak_ii'];
                $data[$key]['cooperation_status'] = strtolower($value['status']);
                $data[$key]['cooperation_focus_id'] = 1;
                $data[$key]['cooperation_type_id'] = 1;
                $data[$key]['cooperation_province_id'] = 1;
                $data[$key]['cooperation_city_id'] = 1;
                $data[$key]['owner_id'] = 6;

                
                // $model->create($data[$key]); 
            }
        }

        // dd($data);
        Session::set('preview', $data );
        Session::set('width', 0 );

// dd(json_encode($data));
        return redirect('admin-cp/cooperation-category/preview');
    }

    public function getPreview()
    {
        // dd(Session::get('preview'));
        return view('backend.kerjasama.import.import-list');
    }

    public function getProgress()
    {

        $model = $this->model;

        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache'); 
          
        function send_message($id, $message, $progress) {
            $d = array('message' => $message , 'progress' => $progress);
              
            echo "id: $id" . PHP_EOL;
            echo "data: " . json_encode($d) . PHP_EOL;
            echo PHP_EOL;
              
            ob_flush();
            flush();
        }
          
            $j= 2230;

            $data = Session::get('preview');
            $current = Carbon::now()->setTimezone('Asia/Jakarta');
            $i=0;
             foreach ($data as $key => $item) {   
                
                $checkNomor = $model->where('cooperation_number',$item['cooperation_number'])->first();

                if(!empty($checkNomor->id)){
                    $checkNomor->update($item);
                }else{
                    $model->create($item);
                }

                $i++;
                $value= number_format(($i/count($data))*100);
                send_message($i, 'on iteration ' . $i . ' of '.count($data) , $value); 

                usleep(500);

                
            }
        //LONG RUNNING TASK
        // for($i = 1; $i <= $j ; $i++) {
        //     send_message($i, 'on iteration ' . $i . ' of '.$j , number_format(($i/$j)*100)); 
         
        //     // sleep(1);
        //     usleep(10000);
        // }
          // echo "<script>alert('masuk');</script>";
        send_message('CLOSE', 'Process complete');
    }
    public function actionGetIndex()
    {
        $submit =request()->get('submit');
        if(!empty($submit) && $submit=="data"){
            $data = Session::get('preview');
            // $percentage = Session::get('width');


            $current = Carbon::now()->setTimezone('Asia/Jakarta');
            $dataku = [];
            $i=0;
             foreach ($data as $key => $item) {   
                $i++;
                $value= number_format(($i/count($data))*100);
                $productexist = Wa::model('product')->where('product_code',$item['product_code'])->first();
                if(empty($productexist->id)){

                    // $product = Wa::model('product');
                    // $product->product_code        = $item['product_code'];
                    // $product->product_name        = $item['product_name'];
                    // $product->product_price       = $item['product_price'];
                    // $product->permalink       = str_slug($item['product_code']);
                    // $product->create_on           = $current;
                    // $product->save();
                $dataku[]=$item;

                }else{

                }

                
            }
            // dd($dataku,Session::get('width'));
            echo '<script  language="javascript" >alert("masuk");</script>';
            flush();
            sleep(1);
            // return response()->json(['response' => 'This is method get ','data' => $dataku]);
        }else{
            $data =Session::get('width');
            // $data =Session::get('width') + 4;
            // Session::set('width', $data);

            return response()->json(['response' => 'This is method get ','data' => $data]);

        }
    }

}
