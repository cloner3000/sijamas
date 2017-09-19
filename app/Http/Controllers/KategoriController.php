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
			$end = explode(',', $end_date);
			if ($end[0] < 1 && $end[1] <= 3) $end = true;
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
		$get['start_year']	= $request->start_year;
		$get['end_year'] 	= $request->end_year;

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


		$model = $model->paginate($this->paging);
		
		return view('frontend.pencarian', compact('model', 'get'));
	}

}
