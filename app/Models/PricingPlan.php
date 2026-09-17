<?php

namespace App\Models;

use App\Enums\PricingPeriod;
use App\Services\PricingPlanService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class PricingPlan extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'price',
        'period',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'period' => PricingPeriod::class,
            'is_active' => 'boolean',
        ];
    }

    public array $translatable = [
        'title',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(PricingPlanFeature::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return asset("images/{$this->image}");
    }

    protected static function booted(): void
    {
        static::saved(fn () => app(PricingPlanService::class)->flush());
        static::deleted(fn () => app(PricingPlanService::class)->flush());
    }
}
