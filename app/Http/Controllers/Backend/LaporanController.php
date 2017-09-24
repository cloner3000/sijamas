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
		$province = CooperationProvince::lists('name','id');
		// dd($province);
	   	return view('backend.laporan.index',compact('model','province'));
	}

	public function postIndex(Request $request)
	{
		$inputs = $request->all();

		return redirect(urlBackendAction('preview?start='.$inputs['start'].'&end='.$inputs['end'].'&category='.$inputs['category'].'&province='.$inputs['province'].'&report='.serialize($inputs['to'])));
	}

	public function getPreview(Request $request)
	{
		// \Carbon\Carbon::createFromFormat('Y-m-d', $value->start_date)->format('d/m/Y')
		$start = $request->get('start');
		$end = $request->get('end');
		$category = $request->get('category');
		$province = $request->get('province');
		$field = $request->get('report');
		$fieldarray = unserialize($request->get('report'));
		$dataField = $this->toName($fieldarray);


    	$model = $this->model->select()->whereBetween('cooperation_signed', [\Carbon\Carbon::CreateFromFormat('d/m/Y', $start)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::CreateFromFormat('d/m/Y', $end)->format('Y-m-d')." 23:59:59"]);
    	if($category){
    		if($category=="ln" || $category=="dn"){
    			$model = $model->where('cooperation_category',$category);
    		}
    	}
    	if($province){    		
    		$model = $model->where('cooperation_province_id',$province);
    	}
    	$model = $model->get();
    	
	   	return view('backend.laporan.view',compact('model','dataField','start','end','category','province','field'));
	}

    public function getExportExcel(Request $request)
    {
        $data= [];
    	$start = $request->get('start');
		$end = $request->get('end');
		$category = $request->get('category');
		$province = $request->get('province');
		$field = $request->get('report');
		$fieldarray = unserialize($request->get('report'));
		$dataField = $this->toName($fieldarray);


    	$model = $this->model
    			->select()
    			->whereBetween('cooperation_signed', [\Carbon\Carbon::CreateFromFormat('d/m/Y', $start)->format('Y-m-d')." 00:00:00", \Carbon\Carbon::CreateFromFormat('d/m/Y', $end)->format('Y-m-d')." 23:59:59"]);

    	if($category){
    		if($category=="ln" || $category=="dn"){
    			$model = $model->where('cooperation_category',$category);
    		}
    	}

    	if($province){    		
    		$model = $model->where('cooperation_province_id',$province);
    	}
    	
    	$model = $model->get();
                                
        foreach ($model as $key => $value) {				
            $data[$key]['No'] = $key+1;
			foreach($dataField as $column){	
				if($column['field']=="scope"){
                $data[$key][$column['name']] = strip_tags($value->$column['field']);

				}elseif($column['field']=="cooperation_type_id"){

                    $cooperation_type_id = $value->cooperationtype()->first();
                	$data[$key][$column['name']] = $cooperation_type_id->name;

				}elseif($column['field']=="cooperation_fokus_id"){

                    $cooperation_fokus_id = $value->cooperationfocus()->first();
                	$data[$key][$column['name']] = $cooperation_fokus_id->name;

				}elseif($column['field']=="province"){

            		$province = $value->province()->first()->name;
                	$data[$key][$column['name']] = $province;

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
					 'name'=>'Kategori'
					],
					[
					 'key'=>3,
					 'field'=>'cooperation_status',
					 'name'=>'Status'
					],
					[
					 'key'=>4,
					 'field'=>'cooperation_type_id',
					 'name'=>'Jenis Kerjasama'
					],
					[
					 'key'=>5,
					 'field'=>'about',
					 'name'=>'Judul Kerja Sama'
					],
					[
					 'key'=>6,
					 'field'=>'partners',
					 'name'=>'Nama Mitra'
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
					[
					 'key'=>9,
					 'field'=>'cooperation_number',
					 'name'=>'Nomor Kerja Sama'
					],
					[
					 'key'=>10,
					 'field'=>'province',
					 'name'=>'Province'
					],
					[
					 'key'=>11,
					 'field'=>'first_sign',
					 'name'=>'Nama Penanda Tangan Pihak I'
					],
					[
					 'key'=>12,
					 'field'=>'first_sign_position',
					 'name'=>'Jabatan Penanda Tangan Pihak I'
					],
					[
					 'key'=>13,
					 'field'=>'second_sign',
					 'name'=>'Nama Penanda Tangan Pihak II'
					],
					[
					 'key'=>14,
					 'field'=>'second_sign_position',
					 'name'=>'Jabatan Penanda Tangan Pihak II'
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
