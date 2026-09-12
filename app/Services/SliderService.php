<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;

class SliderService
{
    protected const CACHE_KEY = 'sliders:active';

    public function getActive()
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return Slider::active()->get();
        });

    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
