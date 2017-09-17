<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use App\Models\Cooperation;
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
		$model = $this->model->whereApproval('approved')->paginate($this->paging);

	   	return view('backend.dashboard.index', compact('model'));
	}

	public function getUsulan()
	{	

	   	return view('backend.dashboard.usulan');
	}

	public function getUpdate()
	{
		
	   	return view('backend.dashboard.update');
	}
}
