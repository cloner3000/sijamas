<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProposedCooperation;
use App\Models\Cooperation;
use App\Models\ProposedCooperationType;
use Illuminate\Http\Request;
use trinata;
use View;
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
		// $this->middleware('auth');
		$this->model = $proposed;
		$kerjasama = Cooperation::whereApproval('approved')->take(3)->orderBy('created_at', 'desc')->get();
		View::share('kerjasama', $kerjasama);

		$this->recaptcha = ['key'=>'6Ld33zAUAAAAAEDZ-pq6TK5Dt3Uqw0Z9zWzGF0zn',
							'secret'=>'6Ld33zAUAAAAABLLDaOyH4nawdgWcPFyDm2UTcja'];
		parent::__construct();

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		// dd('aaa');

		$data = ['model' => $this->model, 'type'=> ProposedCooperationType::orderBy('sort')->get()];

		// dd($data);
		return view('frontend.usulan', compact('data'));
	}

	public function postIndex(Request $request)
	{
		$inputs = $request->except('g-recaptcha-response');
		$inputs['owner_id'] = \App\User::whereRoleId(1)->first()->id;
		

		$validation = \Validator::make($request->all() , $this->rules());
		if($validation->fails())
        {
            $status = 'failed';
            $bags = $validation->getMessageBag();
            $arrayErrors = array_flatten($bags->getMessages());
            $errors = '<ul>';
            foreach($arrayErrors as $key => $val)
            {
                $errors .= "<li>$val</li>";
            }
            $errors .= '</ul>';

            return redirect()->back()->withInfo($errors); 


        }else{

        	$filename = trinata::globalUpload($request, 'filename');
			// dd($filename);
			$inputs['filename'] = $filename['filename'];
			$this->model->create($inputs);
			return redirect('usulan-kerjasama')->withSuccess('data has been saved');
		}
	}

    public function rules()
    {
        return [
            'title'      => 'required',
            'institute'  => 'required',
            'position'   => 'required',
            'address'    => 'required',
            'phone'      => 'required',
            'email'      => 'required',
            'message'    => 'required',
            'filename'   => 'required|mimes:pdf',
        ];
    }



}
