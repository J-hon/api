<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SaveForLater extends Model
{
    protected $fillables = [
        'user_id', 'product_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
