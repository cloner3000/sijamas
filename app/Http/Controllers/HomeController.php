<?php namespace App\Http\Controllers;

use App\Models\Cooperation;
use App\Models\NewsContent;
use View;

class HomeController extends Controller {

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
	public function __construct()
	{
		// // $this->middleware('auth');
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['cooperation'] = Cooperation::whereIn('approval', ['approved'])->orderBy('cooperation_signed', 'desc')->take(1)->get();
		$data['banner'] = NewsContent::whereType('banner')->whereIn('status', ['publish'])->get();

		// dd($data);
		return view('frontend.home', compact('data'));
	}

}
