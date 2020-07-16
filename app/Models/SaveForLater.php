<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveForLater extends Model
{
    protected $fillables = [
        'user_id', 'product_id'
    ];
}
