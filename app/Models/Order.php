<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    // Definiamo quali campi possono essere salvati nel DB
    protected $fillable = [
        'user_id', 
        'address', 
        'city', 
        'courier', 
        'total_price', 
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
