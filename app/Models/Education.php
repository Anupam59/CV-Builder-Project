<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = [
        'customer_id',
        'degree',
        'degree_bn',
        'field_of_study',
        'field_of_study_bn',
        'institute',
        'institute_bn',
        'result',
        'start_year',
        'end_year',
        'description',
        'description_bn',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
