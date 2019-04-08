<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Poster;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'imageable_id', 'img', 'imageable_type'
    ];
    
    public function imageable()
    {
        return $this->morphTo();
    }
}
