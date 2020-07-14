<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Review;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function reviews()
    {
    	return $this->hasMany(Review::class);
    }

}
