<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\ProposedCooperation;
use App\Models\ProposedCooperationType;
use Table;
use Image;
use trinata;

class UsulanController extends TrinataController
{
	public function __construct(ProposedCooperation $proposed)
	{
		parent::__construct();

		$this->model = $proposed;
	}

	public function getData(Request $request)
    {
    	$model = $this->model->select('id','name' ,'title', 'approval', 'created_at');
        if ($request->approval) $model->where('approval', $request->approval);
        if ($request->startdate || $request->enddate) {
            // dd($request->start);
            $start = ($request->startdate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->startdate)->format('Y-m-d') : date('Y-m-d');
            $end = ($request->enddate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->enddate)->format('Y-m-d') : date('Y-m-d');
            // dd($start, $end);
            $model = $model->whereBetween('created_at',[$start, $end]);
            // if ($request->end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $request->end)->format('Y-m-d'));
        }
        // dd($request->all());
    	$data = Table::of($model)
            ->addColumn('action',function($model){
                $status = true;
                return trinata::buttons($model->id , [] , $status);
            })
            
            ->make(true);

        return $data;
    }

	public function getIndex(Request $request)
	{	
		$data = ['proposed' => ProposedCooperation::get(), 'type'=> ProposedCooperationType::get()];
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

	   	return view('backend.usulan.index', compact('data', 'url', 'request','parameter'));
	}

	public function getCreate()
    {
    	// dd('aaaa');
    	$model = $this->model;
    	$data = ['model' => $this->model, 'type'=> ProposedCooperationType::get()];

    	return view('backend.usulan._form',compact('model', 'data'));
    }

    public function postCreate(Request $request)
    {
    	$inputs = $request->all();
		$inputs['owner_id'] = \Auth::user()->id;

		//$filename = trinata::globalUpload($request, 'filename');
		// dd($filename);
        // dd($inputs);
		// $inputs['proposed_cooperation_type_id'] = 1;
		$this->model->create($inputs);
        
		return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

	public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data = ['model' => $this->model, 'type'=> ProposedCooperationType::get()];
        // dd($model);
        return view('backend.usulan._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
    	$model = $this->model->findOrFail($id);

    	$inputs = $request->all();
        $inputs['owner_id'] = \Auth::user()->id;
          
        $model->update($inputs);

        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');

    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
            @unlink(public_path('contents/'.$model->filename));
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


    public function getExportExcel(Request $request)
    {
        $data= [];

        $model = $this->model;

        if ($request->approval) $model = $model->where('approval', $request->approval);
        if ($request->startdate || $request->enddate) {
            // dd($request->start);
            $start = ($request->startdate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->startdate)->format('Y-m-d') : date('Y-m-d');
            $end = ($request->enddate) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $request->enddate)->format('Y-m-d') : date('Y-m-d');
            // dd($start, $end);
            $model = $model->whereBetween('created_at',[$start, $end]);
            // if ($request->end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $request->end)->format('Y-m-d'));
        }

        $model = $model->orderBy('id','asc')->get();

        foreach ($model as $key => $value) {

            $data[$key]['No'] = $key+1;
            $data[$key]['Judul Usulan'] = $value->title;
            $data[$key]['Nama'] = $value->name ;
            $data[$key]['Instansi'] = $value->institute;
            $data[$key]['Jabatan'] = $value->position;
            $data[$key]['Alamat'] = $value->address;
            $data[$key]['Telepon'] = $value->phone;
            $data[$key]['Email'] = $value->email;
            $data[$key]['Isi Pesan'] = $value->message;
            $data[$key]['Jenis Naskah Kerjasama yang Diusulkan'] = $value->name;
            $data[$key]['Status Approval'] = $value->approval;
        }

        \Excel::create('Usulan-Kerjasama', function($excel)  use($data) {

            $excel->sheet('Sheet Name', function($sheet) use($data)  {

                $sheet->fromArray($data);
            
            });
        })->download('xlsx');
    }



}
