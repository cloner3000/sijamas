<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProposedCooperation;
use App\Models\ProposedCooperationType;
use Illuminate\Http\Request;

class UsulanController extends Controller {

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
	public function __construct(ProposedCooperation $proposed)
	{
		$this->middleware('auth');
		$this->model = $proposed;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		// dd('aaa');

		$data = ['model' => $this->model, 'type'=> ProposedCooperationType::get()];

		// dd($data);
		return view('frontend.usulan', compact('data'));
	}

	public function postIndex(Request $request)
	{
		$inputs = $request->all();
		$inputs['owner_id'] = '0';
		
		// dd($inputs);
		$this->model->create($inputs);
		return redirect('usulan')->withSuccess('data has been saved');
	}



}
