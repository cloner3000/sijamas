<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use Carbon\Carbon;

class UsulanController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getIndex()
	{	
	   	return view('backend.usulan.index');
	}

	public function getCreate()
	{	

	   	return view('backend.usulan._form');
	}

	public function getUpdate()
	{
		
	   	return view('backend.usulan._form');
	}
}
