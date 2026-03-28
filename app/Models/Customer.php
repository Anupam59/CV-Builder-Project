<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function cvs(): HasMany
    {
        return $this->hasMany(Cv::class);
    }

    // ── Profile Sections ─────────────────────────────────────────

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class)->latest();
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->latest();
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class)->latest();
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->latest();
    }

    public function languages(): HasMany
    {
        return $this->hasMany(Language::class)->latest();
    }

    public function certifications(): HasMany
    {
        return $this->hasMany(Certification::class)->latest();
    }

    // Future এ এখানে নতুন section add করো:
    // public function awards(): HasMany { ... }
    // public function interests(): HasMany { ... }
}
