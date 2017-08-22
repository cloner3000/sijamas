<?php namespace App\Http\Controllers\Backend\Kerjasama;

/**
 * Sample Crud
 */

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Cooperation;
use App\Models\CooperationImplementation;
use App\Models\CooperationType;
use App\Models\CooperationFocus;
use App\Models\CooperationProvince;
use App\Models\CooperationCity;
use App\Models\CooperationFile;
use Table;
use Image;
use trinata;

class FollowupController extends TrinataController
{
    public function __construct(CooperationImplementation $model)
    {
    	parent::__construct();

    	$this->model = $model;
    }

    public function getData(Request $request)
    {

    	$model = $this->model->join('cooperations', 'cooperation_implementations.cooperation_id', '=', 'cooperations.id')->select('cooperation_implementations.id','cooperations.title as title','cooperation_implementations.implementation_date','cooperation_implementations.activity_type','cooperation_implementations.description');

        // if ($request->approval) $model->where('approval', $request->approval);
        // if ($request->cooperation_category) $model->where('cooperation_category', $request->cooperation_category);
        // if ($request->start) $model->where('cooperation_signed', $request->start);
        // if ($request->end) $model->where('cooperation_ended', $request->end);

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
        // return view('backend.kategori.index');
        // dd($request->all());
        $model = $this->model;
        
    	return view('backend.kerjasama.tindak-lanjut.index', compact('model'));
    }

    public function getCreate()
    {
    	$model = $this->model;
        $data = [
                    'cooperation' => Cooperation::lists('title','id'),
                ];
        
        // dd($cooperationType);
    	return view('backend.kerjasama.tindak-lanjut._form',compact('model', 'data'));
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

        $inputs = $request->all();
        
        $inputs['implementation_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->implementation_date)->format('Y-m-d');
        $inputs['description'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->description)->format('Y-m-d');
        
        $model->create($inputs); 
        
        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data = [
                    'cooperation' => Cooperation::lists('title','id'),
                ];
            
        return view('backend.kerjasama.tindak-lanjut._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($request->id);


        $inputs = $request->all();
        $model->cooperation_id = $request->cooperation_id;
        $model->activity_type = $request->activity_type;
        $model->implementation_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->implementation_date)->format('Y-m-d');
        $model->description = \Carbon\Carbon::createFromFormat('d/m/Y', $request->description)->format('Y-m-d');
        
        $model->save(); 
        
        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
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
