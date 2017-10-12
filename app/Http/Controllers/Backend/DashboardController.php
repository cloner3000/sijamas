<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use App\Models\Cooperation;
use App\Models\ProposedCooperation;
use Carbon\Carbon;

class DashboardController extends TrinataController
{
	public function __construct(Cooperation $model)
	{
		parent::__construct();
		$this->model = $model;
		$this->paging = 10;
	}


	public function getIndex()
	{	
		$model = $this->model->whereApproval('draft')->paginate($this->paging);

	   	return view('backend.dashboard.index', compact('model'));
	}

	public function getUsulan()
	{	
		$model = ProposedCooperation::whereApproval('draft')->paginate($this->paging);

	   	return view('backend.dashboard.usulan', compact('model'));
	}

	public function getUpdate()
	{
		
	   	return view('backend.dashboard.update');
	}

	public function getOpenNotif(Request $request)
	{
		$id = $request->id;
		$type = $request->type;
		// dd($request->all());
		$arrType = ['cooperation'=>'cooperation', 'proposed'=>'proposed'];
		
		$this->logNotif($id, $arrType[$type]);

		return response()->json(['status' => true]);
	}
}
