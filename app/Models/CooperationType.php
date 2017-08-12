<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cooperation;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperationType extends Model
{
    use SoftDeletes;
    protected $table = 'cooperation_types';

    public $guarded = [];

	// public function cooperation()
    // {
		// return $this->belongsTo(Cooperation::class, 'cooperation_type_id');
    // }

}
