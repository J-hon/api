<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Product extends Model
{
    protected $fillable = [
        'name', 'code', 'slug', 'description', 'price', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function reviews()
    {
    	return $this->hasMany(Review::class);
    }

}
