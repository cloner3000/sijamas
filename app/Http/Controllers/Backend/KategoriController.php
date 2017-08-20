<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Chart;
use App\Models\UserActivity;
use Carbon\Carbon;

class KategoriController extends TrinataController
{
	public function __construct()
	{
		parent::__construct();
	}


	public function getIndex()
	{	
	   	return view('backend.kategori.index');
	}

	public function getCreate()
	{
		
	   	return view('backend.kategori._form');
	}

	public function getUpdate()
	{
		
	   	return view('backend.kategori._form');
	}
}
