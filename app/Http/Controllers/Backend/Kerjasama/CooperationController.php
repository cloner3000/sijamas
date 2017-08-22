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
use App\Models\CooperationFile;
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

    public function getData(Request $request)
    {

    	$model = $this->model->select('id','title','cooperation_number','cooperation_category','cooperation_status');
        if ($request->approval) $model->where('approval', $request->approval);
        if ($request->cooperation_category) $model->where('cooperation_category', $request->cooperation_category);
        if ($request->start) $model->where('cooperation_signed', $request->start);
        if ($request->end) $model->where('cooperation_ended', $request->end);

    	$data = Table::of($model)
    		->addColumn('moderation',function($model){
                $status = true;
                return trinata::buttonApprove($model->id, $status);
            })
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
    	return view('backend.kerjasama.daftar.index', compact('model'));
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

        $inputs = $request->except('file', 'image');
        $inputsCoop = $request->all();

        $inputs['cooperation_signed'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $inputs['cooperation_ended'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        $inputs['owner_id'] = \Auth::user()->id;
        
        
        $lastId = $model->create($inputs); 
        
        if ($inputsCoop['file']) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $lastId->id;
            $repo->filename = trinata::globalUpload($request, 'file')['filename'];
            $repo->type = 'document';

            $repo->save();
        } 

        if ($inputsCoop['image']) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $lastId->id;
            $repo->filename = trinata::globalUpload($request, 'image')['filename'];
            $repo->type = 'photo';

            $repo->save();
        } 

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
        $model = $this->model->findOrFail($request->id);


        $inputs = $request->all();
        $model->title = $request->title;
        $model->cooperation_number = $request->cooperation_number;
        $model->cooperation_category = $request->cooperation_category;
        $model->cooperation_status = $request->cooperation_status;
        $model->cooperation_type_id = $request->cooperation_type_id;
        $model->about = $request->about;
        $model->partners = $request->partners;
        $model->cooperation_province_id = $request->cooperation_province_id;
        $model->cooperation_city_id = $request->cooperation_city_id;
        $model->address = $request->address;
        $model->address = $request->address;
        $model->cooperation_signed = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_signed)->format('Y-m-d');
        $model->cooperation_ended = \Carbon\Carbon::createFromFormat('d/m/Y', $request->cooperation_ended)->format('Y-m-d');
        $model->cooperation_focus_id = $request->cooperation_focus_id;
        $model->scope = $request->scope;
        $model->approval = $request->approval;
        $model->save(); 
        
        if (isset($inputs['file'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $model->id;
            $repo->filename = trinata::globalUpload($request, 'file')['filename'];
            $repo->type = 'document';

            $repo->save();
        } 

        if (isset($inputs['image'])) {
            $repo = new CooperationFile;
            $repo->cooperation_id = $model->id;
            $repo->filename = trinata::globalUpload($request, 'image')['filename'];
            $repo->type = 'photo';

            $repo->save();
        } 

        return redirect(urlBackendAction('index'))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        try
        {
            $repo = CooperationFile::whereCooperationId($model->id);
            if ($repo) {
                foreach ($repo as $key => $value) {
                    @unlink(public_path('contents/'.$value->filename));
                }
            }
            
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
