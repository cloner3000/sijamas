<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CooperationType;
use App\Models\CooperationProvince;
use App\Models\CooperationCity;
use App\Models\CooperationImplementation;
use App\Models\CooperationFocus;
use App\Models\CooperationFile;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cooperation extends Model
{
    use SoftDeletes;
    protected $table = 'cooperations';

    public $guarded = [];

	public function cooperationtype()
    {
		return $this->belongsTo(CooperationType::class, 'cooperation_type_id');
    }
	
	public function province()
    {
    	return $this->belongsTo(CooperationProvince::class , 'cooperation_province_id');
    }

    public function city()
    {
        return $this->belongsTo(CooperationCity::class , 'cooperation_city_id');
    }
	
	public function cooperationimplementation()
    {
        return $this->hasMany(CooperationImplementation::class , 'cooperation_id');
    }
	
	public function cooperationfocus()
    {
        return $this->belongsTo(CooperationFocus::class , 'cooperation_focus_id');
    }
	
	public function cooperationfile()
    {
        return $this->hasMany(CooperationFile::class , 'cooperation_id');
    }
		
	public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'owner_id');
    }
}
