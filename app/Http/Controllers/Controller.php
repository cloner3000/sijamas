<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\CooperationType;
use App\Models\Cooperation;
use App\Models\CooperationFocus;
use View;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		$CooperationType = CooperationType::orderBy('name')->get();	
		$CooperationFocus = CooperationFocus::orderBy('name')->get();	
		
		View::share('CooperationType', $CooperationType);
		View::share('CooperationFocus', $CooperationFocus);
	}
}
