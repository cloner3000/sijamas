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
        
        if ($inputsCoop['file']) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $lastId->id;
            $repo->filename = trinata::globalUpload($request, 'file')['filename'];
            $repo->type = 'document';

            $repo->save();
        } 

        if ($inputsCoop['image']) {
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

    public function getCity(Request $request)
    {
        $status = false;
        $model = CooperationCity::where('cooperation_province_id', $request->id)->lists('name', 'id');
        if ($model) $status = true;

        return response()->json(['status' => $status, 'res'=>$model]);
    }

    public function getExportExcel()
    {
        $data= [];
        $model = $this->model->orderBy('id','asc')->get();

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
}
