<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use Carbon\Carbon;

class DashboardController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getIndex()
	{	
	   	return view('backend.dashboard.index');
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
