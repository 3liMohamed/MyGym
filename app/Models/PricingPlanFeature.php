<?php

namespace App\Models;

use App\Services\PricingPlanService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class PricingPlanFeature extends Model
{
    use HasTranslations;

    protected $fillable = [
        'pricing_plan_id',
        'text',
    ];

    public array $translatable = ['text'];

    public function pricingPlan(): BelongsTo
    {
        return $this->belongsTo(PricingPlan::class);
    }

    protected static function booted(): void
    {
        static::saved(fn () => app(PricingPlanService::class)->flush());
        static::deleted(fn () => app(PricingPlanService::class)->flush());
    }
}
