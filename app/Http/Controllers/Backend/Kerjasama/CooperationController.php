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

    public function getData()
    {
    	$model = $this->model->select('id','title','cooperation_number','cooperation_category','cooperation_status');

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
    	return view('backend.kerjasama.daftar.index');
    }

    public function getCreate()
    {
    	$model = $this->model;
        $data = [
                    'cooperationType' => CooperationType::lists('name','id'),
                    'cooperationFocus' => CooperationFocus::lists('name','id'),
                    'province' => CooperationProvince::lists('name','id'),
                    'city' => CooperationCity::lists('name','id'),
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

        // $this->validate($request,$model->rules());

        $inputs = $request->all();

        // $inputs['image'] = $this->handleUpload($request,$model);
        $inputs['cooperation_signed'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $inputs['cooperation_ended'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        $inputs['owner_id'] = \Auth::user()->id;
        // dd($inputs);
        $model->create($inputs); 

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data = [
                    'cooperationType' => CooperationType::lists('name','id'),
                    'cooperationFocus' => CooperationFocus::lists('name','id'),
                    'province' => CooperationProvince::lists('name','id'),
                    'city' => CooperationCity::lists('name','id'),
                ];

        return view('backend.kerjasama.daftar._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);

        // $this->validate($request,$model->rules());

        $inputs = $request->all();

        // $inputs['image'] = $this->handleUpload($request,$model);
        $inputs['cooperation_signed'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $inputs['cooperation_ended'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        
        $model->update($inputs);

        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
            @unlink(public_path('contents/'.$model->image));
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
