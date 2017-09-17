<?php namespace App\Http\Controllers;

use App\Models\CooperationType;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Cooperation;
use View;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
	{
		$CooperationType = CooperationType::orderBy('name')->get();	
		
		View::share('CooperationType', $CooperationType);
	}
}
