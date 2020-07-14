<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Review extends Model
{
    protected $fillable = [
        'rating', 'title', 'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
