<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cooperation;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperationFile extends Model
{
    use SoftDeletes;
    protected $table = 'cooperation_files';

    public $guarded = [];

	// public function cooperation()
    // {
		// return $this->belongsTo(Cooperation::class, 'cooperation_id');
    // }
	
}