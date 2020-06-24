<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function product()
    {
        return $this->belongsTo('App\Category');
    }

}
