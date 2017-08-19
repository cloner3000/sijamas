<?php namespace App\Http\Controllers\Backend\PageStatic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\NewsContent;
use Table;
use Image;
use trinata;

class BannerController extends TrinataController
{
    public function __construct(NewsContent $model)
    {
    	parent::__construct();

    	$this->model = $model;
    }

    public function getData()
    {
    	$model = $this->model->select('id','title' ,'brief', 'status')->whereType('banner');

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
    	return view('backend.pagestatic.banner.index');
    }

    public function getCreate()
    {
    	$model = $this->model;

    	return view('backend.pagestatic.banner._form',compact('model'));
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

        $inputs['status'] = $request->status;
        $inputs['brief'] = $this->handleUpload($request,$model) ? $this->handleUpload($request,$model) : 'no image';
        $inputs['owner_id'] = \Auth::user()->id;
        $inputs['type'] = 'banner';

        $model->create($inputs);

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        return view('backend.pagestatic.banner._form',compact('model'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);

        // $this->validate($request,$model->rules());

        $inputs = $request->all();

        
        $inputs['brief'] = $this->handleUpload($request,$model) ? $this->handleUpload($request,$model) : 'no image';
        $inputs['owner_id'] = \Auth::user()->id;
        
        $model->update($inputs);

        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
            @unlink(public_path('contents/'.$model->brief));
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
