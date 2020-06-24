<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveForLater extends Model
{
    protected $fillables = [
        'user_id', 'product_id'
    ];
}
