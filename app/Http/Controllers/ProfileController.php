<?php namespace App\Http\Controllers;


use App\Models\NewsContent;
use App\Models\Cooperation;
use View;

class ProfileController extends Controller {

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
	public function __construct(NewsContent $model)
	{
		// $this->middleware('auth');
		$this->model = $model;
		
		$kerjasama = Cooperation::whereApproval('approved')->take(3)->get();
		View::share('kerjasama', $kerjasama);
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$model = $this->model->whereType('profile')->first();

		return view('frontend.profile', compact('model'));
	}

}
