<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Notification extends Model
{
    
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(new User);
    }
	
}