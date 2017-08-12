<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cooperation;
use App\Models\CooperationProvince;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperationCity extends Model
{
    use SoftDeletes;
    protected $table = 'cooperation_cities';

    public $guarded = [];

	// public function cooperation()
    // {
		// return $this->belongsTo(Cooperation::class, 'cooperation_city_id');
    // }
	
	// public function province()
    // {
    	// return $this->belongsTo(CooperationProvince::class , 'cooperation_province_id');
    // }

}