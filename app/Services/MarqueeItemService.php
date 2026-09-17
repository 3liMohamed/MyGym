<?php

namespace App\Services;

use App\Models\MarqueeItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MarqueeItemService
{
    protected const CACHE_KEY = 'marquee_items:active';

    public function getActive(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return MarqueeItem::active()->get();
        });
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
