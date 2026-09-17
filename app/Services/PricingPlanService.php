<?php

namespace App\Services;

use App\Models\PricingPlan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PricingPlanService
{
    protected const CACHE_KEY = 'pricing_plans:active';
    protected const MAX_ACTIVE = 3;

    public function getActive(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return PricingPlan::active()->with('features')->get();
        });
    }

    public function toggleActive(PricingPlan $plan, bool $active): bool
    {
        if ($active && $this->activeCount(excluding: $plan) >= self::MAX_ACTIVE) {
            return false;
        }

        $plan->update(['is_active' => $active]);

        return true;
    }

    public function activeCount(?PricingPlan $excluding = null): int
    {
        return PricingPlan::query()
            ->active()
            ->when($excluding, fn ($query) => $query->whereKeyNot($excluding->getKey()))
            ->count();
    }

    public function maxActive(): int
    {
        return self::MAX_ACTIVE;
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
