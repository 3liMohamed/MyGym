<?php

namespace App\Models;

use App\Services\MarqueeItemService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MarqueeItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'text',
        'is_highlighted',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public array $translatable = [
        'text',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    protected static function booted(): void
    {
        static::saved(fn () => app(MarqueeItemService::class)->flush());
        static::deleted(fn () => app(MarqueeItemService::class)->flush());
    }
}
