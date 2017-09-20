<?php namespace App\Http\Controllers;

use App\Models\Cooperation;
use Illuminate\Http\Request;
use View;
class KategoriController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Cooperation $model)
	{
		// $this->middleware('auth');
		$this->model = $model;
		$kerjasama = Cooperation::whereApproval('approved')->take(3)->get();
		View::share('kerjasama', $kerjasama);
		$this->paging = 5;
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$model = $this->model->whereApproval('approved')->get();
		// dd($model[1]->cooperationfile);
		return view('frontend.kategori', compact('model'));
	}

	public function getLuarNegeri()
	{
		$model = $this->model->whereApproval('approved')->whereCooperationCategory('ln')->paginate($this->paging);
		// dd($model[1]->cooperationfile);
		$flag = 1;
		return view('frontend.kategori', compact('model', 'flag'));
	}

	public function getDalamNegeri()
	{
		$model = $this->model->whereApproval('approved')->whereCooperationCategory('dn')->paginate($this->paging);
		// dd($model);
		// dd($model[1]->cooperationfile);
		$flag = 2;
		return view('frontend.kategori', compact('model', 'flag'));
	}

	public function read($slug=false)
	{

		$model = $this->model->whereSlug($slug)->first();

		// dd($model->cooperation_signed);
		$end_date = \Carbon\Carbon::CreateFromFormat('Y-m-d', $model->cooperation_ended)->diff(\Carbon\Carbon::now())->format("%y,%m");
		$end = false;
		if ($end_date) {
			$ends = explode(',', $end_date);
			if ($ends[0] < 1 && $ends[1] <= 3) $end = true;
		}
		// dd($model->cooperationimplementation);
		return view('frontend.kategori-detail', compact('model','end'));
	}

	public function getPencarian(Request $request)
	{
		// dd('masuk');
		$model = $this->model->whereApproval('approved');
		
		$get['start_date'] = $request->start_date;
		$get['end_date'] 	= $request->end_date;
		$get['kategori'] 	= $request->kategori;
		$get['jenis']		= $request->jenis;
		$get['bidang'] 	= $request->bidang;
		$get['status'] 	= $request->status;
		$get['keyword'] 	= $request->keyword;
		// $get['start_year']	= $request->start_year;
		// $get['end_year'] 	= $request->end_year;
		$search = $get['keyword'];
        
		if($get['kategori']){
			if($get['kategori']=="ln" || $get['kategori'] =="dn"){
				$model = $model->whereCooperationCategory($get['kategori']);
			}
		}
		if($get['jenis']){
			$model = $model->whereCooperationTypeId($get['jenis']);
		}
		if($get['bidang']){
			$model = $model->whereCooperationFocusId($get['bidang']);
		}
		if($get['status']){
			if($get['kategori']=="baru" || $get['kategori'] =="lanjutan"){
				$model = $model->whereCooperationCategory($get['kategori']);
			}
		}
		if($search){
			$model = $model->where(function($query) use ($search) {
		                    return $query
		                            ->where('title','like','%'.$search.'%')
		                            ->orWhere('cooperation_number','like','%'.$search.'%')
		                            ->orWhere('about','like','%'.$search.'%')
		                            ->orWhere('partners','like','%'.$search.'%')
		                            ->orWhere('address','like','%'.$search.'%')
		                            ->orWhere('scope','like','%'.$search.'%')
		                            ->orWhere('first_sign','like','%'.$search.'%')
		                            ->orWhere('second_sign','like','%'.$search.'%');
		                });
		}
		if ($get['start_date'] || $get['end_date']) {
            // dd($request->start);
            $start = ($get['start_date']) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $get['start_date'])->format('Y-m-d') : date('Y-m-d');
            $end = ($get['end_date']) ? \Carbon\Carbon::CreateFromFormat('d/m/Y', $get['end_date'])->format('Y-m-d') : date('Y-m-d');
            // dd($start, $end);
            $model = $model->whereBetween('cooperation_signed',[$start, $end]);
            // if ($request->end) $model->where('cooperation_signed', '<=',\Carbon\Carbon::CreateFromFormat('d/m/Y', $request->end)->format('Y-m-d'));
        }

		$model = $model->paginate($this->paging)->appends([
													'start_date' => $get['start_date'] ,
													'end_date' => $get['end_date'],
													'kategori' => $get['kategori'],
													'jenis' => $get['jenis'],
													'bidang' => $get['bidang'],
													'status' => $get['status'],
													'keyword' => $get['keyword'],
													]);
		
		return view('frontend.pencarian', compact('model', 'get'));
	}

}
