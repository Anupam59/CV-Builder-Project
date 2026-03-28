<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'customer_id',
        'title',
        'title_bn',
        'role',
        'role_bn',
        'technologies',
        'technologies_bn',
        'project_url',
        'description',
        'description_bn',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
