<?php namespace App\Http\Controllers\Backend\Location;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\CooperationProvince;
use App\Models\CooperationCity;
use Table;
use Image;
use trinata;

class CityController extends TrinataController
{
	public function __construct(CooperationCity $proposed)
	{
		parent::__construct();

		$this->model = $proposed;
	}

	public function getData()
    {
    	$model = $this->model->join('cooperation_provinces', 'cooperation_cities.cooperation_province_id','=', 'cooperation_provinces.id')->select('cooperation_cities.id','cooperation_cities.name', 'cooperation_provinces.name as province');

    	$data = Table::of($model)
    		
    		->addColumn('action',function($model){
                $status = true;
    			return trinata::buttons($model->id , [] , $status);
    		})
    		
    		->make(true);

    	return $data;
    }

	public function getIndex()
	{	
		$model = $this->model;
	   	return view('backend.location.city.index', compact('model'));
	}

	public function getCreate()
    {
    	// dd('aaaa');
    	$model = $this->model;
        $data['province'] = CooperationProvince::lists('name','id');
    	
    	return view('backend.location.city._form',compact('model', 'data'));
    }

    public function postCreate(Request $request)
    {
    	$inputs = $request->all();
		
        $this->model->create($inputs);
        
		return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

	public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data['province'] = CooperationProvince::lists('name','id');
        
        return view('backend.location.city._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
    	$model = $this->model->findOrFail($id);

    	$inputs = $request->all();
       
        
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



}
