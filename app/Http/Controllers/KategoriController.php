<?php namespace App\Http\Controllers;

use App\Models\Cooperation;
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
		$kerjasama = Cooperation::whereApproval('approved')->get();
		View::share('kerjasama', $kerjasama);
		$this->paging = 1;
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
		return view('frontend.kategori', compact('model'));
	}

	public function getDalamNegeri()
	{
		$model = $this->model->whereApproval('approved')->whereCooperationCategory('dn')->paginate($this->paging);
		// dd($model);
		// dd($model[1]->cooperationfile);
		return view('frontend.kategori', compact('model'));
	}

	public function read()
	{
		return view('frontend.kategori-detail');
	}

}
