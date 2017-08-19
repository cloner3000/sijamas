<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\NewsContent;


class ProfileController extends TrinataController
{
    public function __construct(NewsContent $model)
    {
    	parent::__construct();

        $this->model = $model;

    }

    public function getData()
    {
        $model = $this->model->whereParentId(null)->whereType('profile')->first();

        $model = $this->model->whereParentId($data->id)->select('id' , 'title','description')->whereType('profile');
        
    }

    public function getIndex()
    {
        $model = $this->model->whereParentId(null)->whereType('profile')->first();


    	return view('backend.profile.index',compact('model'));
    }

    public function handleInsert($request)
    {
    	$inputs = $request->all();

    	$inputs['password'] = \Hash::make($request->password);
    	$inputs['role_id'] = $this->model->role_id;
    	return $inputs;
    }

    public function postIndex(Request $request)
    {
        $inputs = $request->all();
        
        $values = [
            'title' => $request->title,
            'description' => $request->description,
            'type' => 'profile',
        ];

        if(!empty($request->id)){

            $save = $this->model->whereId($request->id)->update($values);
            $dataid=$save;
        }else{

            $save = $this->model->create($values);
            $dataid=$save->id;
        }

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');     
    }

    public function postCreate(Request $request)
    {
        
        $data = $this->model->whereParentId(null)->whereType('profile')->first();

        if(!empty($data->id)){
            $inputs = $request->all();
        
            $values = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category' => 'profile',
            ];
            
            $save = $this->model->create($values);

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');     
            
        }else{

        return redirect()->back()->withMessage('Sory Data Parent Not Found!');

        }
        
    }

    public function postUpdate(Request $request , $id)
    {
                    
        $values = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ];

        $update = $this->model->whereId($id)->update($values);
        
        return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
    }

    public function getPublish($id)
    {
        $model = $this->model->find($id);
        if(!empty($model->id))
        {
            if($model->status == 'y')
            {
                $updateStatus = 'n';
                $message = 'Data has been unpublished';
                $words = 'Unpublished';
            }else{
                $updateStatus = 'y';
                $message = 'Data has been published';
                $words = 'Published';
            }

            Trinata::history($words , '' , ['id' => $id]);
            $model->update(['status' => $updateStatus]);
            return redirect()->back()->withMessage($message);
        }else{

            return redirect()->back()->withMessage('something wrong');

        }
    }

}
