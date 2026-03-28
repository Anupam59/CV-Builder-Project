<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerDetail extends Model
{
    protected $fillable = [
        'customer_id',
        'father_name',
        'father_name_bn',
        'mother_name',
        'mother_name_bn',
        'date_of_birth',
        'gender',
        'marital_status',
        'nationality',
        'nationality_bn',
        'religion',
        'religion_bn',
        'nid_number',
        'profession',
        'profession_bn',
        'profile_summary',
        'profile_summary_bn',
        'website',
        'linkedin',
        'github',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
