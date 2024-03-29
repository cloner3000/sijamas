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
		return $this->belongsTo(new CooperationType, 'cooperation_type_id');
    }
	
	public function province()
    {
    	return $this->belongsTo(new CooperationProvince , 'cooperation_province_id');
    }

    public function city()
    {
        return $this->belongsTo(new CooperationCity , 'cooperation_city_id');
    }
	
	public function cooperationimplementation()
    {
        return $this->hasMany(new CooperationImplementation , 'cooperation_id')->orderBy('implementation_date','desc');
    }
	
	public function cooperationfocus()
    {
        return $this->belongsTo(new CooperationFocus , 'cooperation_focus_id');
    }
	
	public function cooperationfile()
    {
        return $this->hasMany(new CooperationFile)->whereType('document');
    }

    public function cooperationFoto()
    {
        return $this->hasMany(new CooperationFile)->whereType('photo');
    }
		
	public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'owner_id');
    }
}
