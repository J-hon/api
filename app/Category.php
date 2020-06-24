<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillables = [
        'name'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
