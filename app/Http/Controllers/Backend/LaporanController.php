<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use App\Models\Cooperation;
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
		$end = $request->get('end');
		$field = $request->get('report');
		$fieldarray = unserialize($request->get('report'));
		$dataField = $this->toName($fieldarray);

	   	return view('backend.laporan.view',compact('dataField','start','end','field'));
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
					 'field'=>'nomor',
					 'name'=>'Nomor Kerjasama'
					],
					[
					 'key'=>2,
					 'field'=>'kategori',
					 'name'=>'Kategori Kerjasama'
					],
					[
					 'key'=>3,
					 'field'=>'status',
					 'name'=>'Kategori Status Kerjasama'
					],
					[
					 'key'=>4,
					 'field'=>'jenis',
					 'name'=>'Jenis Kerjasama'
					],
					[
					 'key'=>5,
					 'field'=>'tentang',
					 'name'=>'Tentang Kerjasama'
					],
					[
					 'key'=>6,
					 'field'=>'mitra',
					 'name'=>'Mitra Kerjasama'
					],
					[
					 'key'=>7,
					 'field'=>'bidang',
					 'name'=>'Bidang Fokus'
					],
					[
					 'key'=>8,
					 'field'=>'ruang',
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
