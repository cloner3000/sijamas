<?php namespace App\Http\Controllers\Backend\PageStatic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\NewsContent;
use trinata;


class ProfileController extends TrinataController
{
    public function __construct(NewsContent $model)
    {
    	parent::__construct();

        $this->model = $model;

    }

    public function getData()
    {
        $model = $this->model->whereType('profile')->first();

        $model = $this->model->select('id' , 'title','description')->whereType('profile');
        
    }

    public function getIndex()
    {
       
        $model = $this->model->whereType('profile')->first();

        // dd($model);

    	return view('backend.pagestatic.profile.index',compact('model'));
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
        // $inputs = $request->all();
        
        $model = $request->id ? $this->model->find($request->id) : $this->model;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->owner_id = \Auth::user()->id;
        $model->status = 'publish';
        $model->type = 'profile';

        $model->save();

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');     
    }

    public function postCreate(Request $request)
    {
        
        $data = $this->model->whereType('profile')->first();

        if(!empty($data->id)){
            $inputs = $request->all();
        
            $values = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => 'publish',
                'type' => 'profile'
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
            'owner_id' => \Auth::user()->id,
            'status' => 'publish'
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
