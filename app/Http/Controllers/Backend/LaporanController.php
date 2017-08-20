<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use App\Models\Cooperation;
use Carbon\Carbon;

class LaporanController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
		$this->model = new Cooperation;
	}


	public function getIndex()
	{	
		$model = $this->model;
	   	return view('backend.laporan.index',compact('model'));
	}

	public function postIndex(Request $request)
	{
		dd($request->all());
	}

}
