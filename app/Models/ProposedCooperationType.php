<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProposedCooperation;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProposedCooperationType extends Model
{
    use SoftDeletes;
    protected $table = 'proposed_cooperation_types';

    public $guarded = [];

	// public function proposedcooperation()
    // {
		// return $this->belongsTo(ProposedCooperation::class, 'proposed_cooperation_type_id');
    // }

}
