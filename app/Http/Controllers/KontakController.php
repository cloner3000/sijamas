<?php namespace App\Http\Controllers;

use App\Models\Cooperation;
use View;
class KontakController extends Controller {

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
		// $this->middleware('auth');
		$kerjasama = Cooperation::whereApproval('approved')->take(3)->get();
		View::share('kerjasama', $kerjasama);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('frontend.kontak');
	}

}
