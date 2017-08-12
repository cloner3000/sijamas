<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cooperation;
use App\Models\CooperationCity;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperationProvince extends Model
{
    use SoftDeletes;
    protected $table = 'cooperation_provinces';

    public $guarded = [];

	// public function cooperation()
    // {
		// return $this->belongsTo(Cooperation::class, 'cooperation_province_id');
    // }
	
	public function city()
    {
        return $this->hasMany(CooperationFile::class , 'cooperation_province_id');
    }

}