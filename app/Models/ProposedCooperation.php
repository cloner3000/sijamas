<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProposedCooperationType;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProposedCooperation extends Model
{
    use SoftDeletes;
    protected $table = 'proposed_cooperations';

    public $guarded = [];

	public function proposedcooperationtype()
    {
        return $this->belongsTo(ProposedCooperationType::class , 'proposed_cooperation_type_id');
    }
			
	public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'owner_id');
    }
}
