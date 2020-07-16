<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

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
