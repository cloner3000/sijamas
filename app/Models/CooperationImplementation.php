<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cooperation;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperationImplementation extends Model
{
    use SoftDeletes;
    protected $table = 'cooperation_implementations';

    public $guarded = [];

	// public function cooperation()
    // {
		// return $this->belongsTo(Cooperation::class, 'cooperation_id');
    // }
	public function implementationDateAttribute($value)
    {
        $this->attributes['implementation_date'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('j F Y');
    }

    public function user()
    {
        return $this->belongsTo('App\User' , 'user_id');
    }
}