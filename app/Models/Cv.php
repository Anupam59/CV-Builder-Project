<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cv extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'title',
        'language',
        'template_name',
        'snapshot',
        'is_locked',
    ];

    protected function casts(): array
    {
        return [
            'snapshot'  => 'array',
            'is_locked' => 'boolean',
        ];
    }

    // ── Relations ─────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function snapshots(): HasMany
    {
        return $this->hasMany(CvSnapshot::class)->orderByDesc('version');
    }

    public function latestSnapshot(): HasOne
    {
        return $this->hasOne(CvSnapshot::class)->latestOfMany('version');
    }

    // ── Helpers ───────────────────────────────────────────────────

    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    public function getNextVersion(): int
    {
        return ($this->snapshots()->max('version') ?? 0) + 1;
    }

    /**
     * Available templates list — নতুন template যোগ করতে এখানেই add করো
     */
    public static function availableTemplates(): array
    {
        return [
            'template_1' => [
                'name'        => 'Modern Clean',
                'description' => 'Clean and professional layout with sidebar',
                'preview_bg'  => '#f0f4ff',
                'accent'      => '#3b5bdb',
            ],
            'template_2' => [
                'name'        => 'Classic Professional',
                'description' => 'Traditional top-to-bottom format',
                'preview_bg'  => '#fff9f0',
                'accent'      => '#e67700',
            ],
            'template_3' => [
                'name'        => 'Creative Bold',
                'description' => 'Bold colors with creative layout',
                'preview_bg'  => '#f0fff4',
                'accent'      => '#2f9e44',
            ],
        ];
    }
}
