<?php

namespace App\Services;

use App\Models\MarketingItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MarketingItemService
{
    protected const CACHE_KEY = 'marketing_items:active';

    public function getActive(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return MarketingItem::active()->get();
        });
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
