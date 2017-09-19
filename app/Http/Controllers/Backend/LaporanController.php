<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use App\Models\Cooperation;
use App\Models\CooperationType;
use App\Models\CooperationFocus;
use App\Models\CooperationProvince;
use App\Models\CooperationCity;
use App\Models\CooperationFile;
use Carbon\Carbon;

class LaporanController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new Cooperation;
	}


	public function getIndex()
	{	
		$model = $this->model;
	   	return view('backend.laporan.index',compact('model'));
	}

	public function postIndex(Request $request)
	{
		$inputs = $request->all();

		return redirect(urlBackendAction('preview?start='.$inputs['start'].'&end='.$inputs['end'].'&report='.serialize($inputs['to'])));
	}

	public function getPreview(Request $request)
	{
		// \Carbon\Carbon::createFromFormat('Y-m-d', $value->start_date)->format('d/m/Y')
		$start = $request->get('start');
		$end = $request->get('end');
		$field = $request->get('report');
		$fieldarray = unserialize($request->get('report'));
		$dataField = $this->toName($fieldarray);


    	$model = $this->model->select()->whereBetween('cooperation_signed', [\Carbon\Carbon::CreateFromFormat('d/m/Y', $start)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::CreateFromFormat('d/m/Y', $end)->format('Y-m-d')." 23:59:59"])->get();
// dd($model->get(),$request->all());
        // if (\Auth::user()->role_id != 1) $model->whereOwnerId(\Auth::user()->id);
        
        // if ($start) $model->where('cooperation_signed', '>=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $start)->format('Y-m-d'));
        // if ($end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $end)->format('Y-m-d'));

		// ->whereBetween('cooperation_signed', [$start." 00:00:00", $end." 23:59:59"]);

        // $model = $model->get();
        // dd($model);
	   	return view('backend.laporan.view',compact('model','dataField','start','end','field'));
	}

    public function getExportExcel(Request $request)
    {
    	$start = $request->get('start');
		$end = $request->get('end');
		$field = $request->get('report');
		$fieldarray = unserialize($request->get('report'));
		$dataField = $this->toName($fieldarray);


    	$model = $this->model->select()->whereBetween('cooperation_signed', [\Carbon\Carbon::CreateFromFormat('d/m/Y', $start)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::CreateFromFormat('d/m/Y', $end)->format('Y-m-d')." 23:59:59"])->get();
        // $model = $this->model->orderBy('id','asc')->get();

                                
        foreach ($model as $key => $value) {				
            $data[$key]['No'] = $key+1;
			foreach($dataField as $column){	
				if($column['field']=="scope"){
                $data[$key][$column['name']] = strip_tags($value->$column['field']);

				}else{
                $data[$key][$column['name']] = $value->$column['field'];

				}			
			}
        }

        \Excel::create('Laporan-Kerjasama', function($excel)  use($data) {

            $excel->sheet('Sheet Name', function($sheet) use($data)  {

                $sheet->fromArray($data);
            
            });
        })->download('xlsx');
    }

	public function toName($field)
	{
		$data = [];
		foreach ($field as $key => $value) {

			$data[]=$this->dataField($value);

		}

		return $data;
	}

	public function dataField($key=1)
	{
		$field = [
					[
					 'key'=>1,
					 'field'=>'cooperation_number',
					 'name'=>'Nomor Kerjasama'
					],
					[
					 'key'=>2,
					 'field'=>'cooperation_category',
					 'name'=>'Kategori Kerjasama'
					],
					[
					 'key'=>3,
					 'field'=>'cooperation_status',
					 'name'=>'Kategori Status Kerjasama'
					],
					[
					 'key'=>4,
					 'field'=>'cooperation_type_id',
					 'name'=>'Jenis Kerjasama'
					],
					[
					 'key'=>5,
					 'field'=>'about',
					 'name'=>'Tentang Kerjasama'
					],
					[
					 'key'=>6,
					 'field'=>'partners',
					 'name'=>'Mitra Kerjasama'
					],
					[
					 'key'=>7,
					 'field'=>'cooperation_fokus_id',
					 'name'=>'Bidang Fokus'
					],
					[
					 'key'=>8,
					 'field'=>'scope',
					 'name'=>'Ruang Lingkup'
					],
		];

		foreach ($field as $value) {
			if($value['key']==$key){
				return $value;
			}
		}
		return $field[0];
	}

}
