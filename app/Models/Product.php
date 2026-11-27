<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'manufacturer',
        'type',
        'is_active',
    ];

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }
}
