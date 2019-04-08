<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Poster extends Model
{
    protected $fillable = [
        'lat', 'lon', 'user_id', 'message', 'status'
    ];
    
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable')->select(['img']);
    }
    
    protected static function boot()
	{
	    parent::boot();
	    static::saving(function($poster)
	    {
	        $poster->user_id = auth()->user()->id;
	    });
	}
    
    public function user()
    {
        return $this->belongsTo('App\User')->select(['name']);
    }
}
