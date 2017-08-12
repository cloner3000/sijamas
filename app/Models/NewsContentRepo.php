<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NewsContent;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsContentRepo extends Model
{
    use SoftDeletes;
    protected $table = 'news_content_repos';

    public $guarded = [];


    // public function user()
    // {
    	// return $this->belongsTo('App\Models\User' , 'author_id');
    // }
	
	// public function news()
    // {
    	// return $this->belongsTo(NewsContent::class , 'news_content_id');
    // }
}
