<?php namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\ProposedCooperationType;
use Table;
use Image;
use trinata;

class UsulanTypeController extends TrinataController
{
	public function __construct(ProposedCooperationType $proposed)
	{
		parent::__construct();

		$this->model = $proposed;
	}

	public function getData()
    {
    	$model = $this->model->select('id','name', 'sort')->orderBy('sort');

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
		
	   	return view('backend.usulan.type.index');
	}

	public function getCreate()
    {
    	// dd('aaaa');
    	$model = $this->model;
    	
    	return view('backend.usulan.type._form',compact('model'));
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

        return view('backend.usulan.type._form',compact('model'));
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
