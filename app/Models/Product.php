<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

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
