<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NewsContentRepo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsContent extends Model
{
    use SoftDeletes;
    
    protected $table = 'news_contents';

    public $guarded = [];

	public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'owner_id');
    }
	
	public function repo()
    {
    	return $this->hasMany(NewsContentRepo::class , 'news_content_id');
    }
	
}