<?php

namespace App\Services;

use App\Models\GymClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class GymClassService
{
    protected const CACHE_KEY = 'gym_classes:active';

    public function getGroupedByDay(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return GymClass::active()->get()->groupBy(fn (GymClass $class) => $class->day->value);
        });
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
