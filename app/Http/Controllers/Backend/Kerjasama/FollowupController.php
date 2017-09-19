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
    public function __construct(CooperationImplementation $model, Cooperation $cooperation)
    {
        parent::__construct();

        $this->model = $model;
        $this->cooperation = $cooperation;
    }

    public function getData(Request $request)
    {

        $model = $this->cooperation->select('id','title','cooperation_number','cooperation_category','cooperation_status', 'approval')->whereApproval('approved');
        // if ($request->approval) $model->where('approval', $request->approval);
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
                return trinata::buttons($model->id , ['view'] , $status);
            })
            
            ->make(true);

        return $data;
    }

    public function getIndex(Request $request)
    {
        // return view('backend.kategori.index');
        // dd($request->all());
        $model = $this->cooperation;


        return view('backend.kerjasama.tindak-lanjut.perencanaan.index', compact('model'));
    }

    public function getDataimplementation(Request $request)
    {

        $model = $this->model->whereCategory('perencanaan');
        if ($request->id) $model->where('cooperation_id', $request->id);
        if ($request->start) $model->where('cooperation_signed', $request->start);
        if ($request->end) $model->where('cooperation_ended', $request->end);

        $data = Table::of($model)
            ->addColumn('moderation',function($model){
                $status = true;
                return trinata::buttonApprove($model->id, $status);
            })
            ->addColumn('action',function($model){
                $status = true;
                return trinata::buttons($model->id , ['update', 'delete'] , $status);
            })
            
            ->make(true);

        return $data;
    }

    public function getView($id, Request $request)
    {
        $model = $this->model;
        $cooperation_id = $id;

        $param = [];
        $url = 'dataimplementation';
        if ($id) $param[] = 'id='.$id;
        if ($request->start) $param[] = 'start='.$request->start;
        if ($request->end) $param[] = 'end='.$request->end;

        if (count($param) > 0) {
            $url = $url.'?'.implode('&', $param);
        }

        return view('backend.kerjasama.tindak-lanjut.perencanaan.perencanaan', compact('model', 'cooperation_id', 'url', 'id'));
    }

    public function getCreate($id=false)
    {
        $model = $this->model;
        $data = [
                    'cooperation' => Cooperation::lists('title','id'),
                ];
        
        // dd($cooperationType);
        $cooperation_id = $id;

        return view('backend.kerjasama.tindak-lanjut.perencanaan._form',compact('model', 'data', 'cooperation_id'));
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
        $inputs['description'] = $request->description;
        $inputs['category'] = 'perencanaan';
        
        // dd($inputs);
        $model->create($inputs); 
        
        return redirect(urlBackendAction('view/'.$request->cooperation_id))->withSuccess('data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $data = [
                    'cooperation' => Cooperation::lists('title','id'),
                ];
        
            
        return view('backend.kerjasama.tindak-lanjut.perencanaan._form',compact('model', 'data'));
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($request->id);


        $inputs = $request->all();
        $model->cooperation_id = $request->cooperation_id;
        $model->activity_type = $request->activity_type;
        $model->implementation_date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->implementation_date)->format('Y-m-d');
        $model->description = $request->description;
        
        $model->save(); 
        
        return redirect(urlBackendAction('view/'.$request->cooperation_id))->withSuccess('data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        $cooperation_id = $model->cooperation_id;
        try
        {
            $model->delete();
            return redirect(urlBackendAction('view/'.$cooperation_id))->withSuccess('data has been deleted');
        
        }catch(\Exception $e){
        
            return redirect(urlBackendAction('view/'.$cooperation_id))->withInfo('data cannot be deleted');
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

    public function getExportExcel($id, Request $request)
    {

        $model = $this->model->where('cooperation_id',$id)->where('category','perencanaan')->orderBy('id','asc')->get();

        foreach ($model as $key => $value) {

            $data[$key]['No'] = $key+1;
            $data[$key]['Tanggal Implementasi'] = $value->implementation_date;
            $data[$key]['Jenis Kegiatan'] = $value->activity_type ;
            $data[$key]['Keterangan'] = strip_tags($value->description) ;
            $data[$key]['Tindak Lanjut'] = 'Perencanaan';
        }

        \Excel::create('Tindak-Lanjut-Perencanaan', function($excel)  use($data) {

            $excel->sheet('Sheet Name', function($sheet) use($data)  {

                $sheet->fromArray($data);
            
            });
        })->download('xlsx');
    }
}
