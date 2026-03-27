<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cv extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'title',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array', // JSON auto cast
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
