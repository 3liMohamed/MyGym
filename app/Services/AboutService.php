<?php

namespace App\Services;

use App\Models\About;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AboutService
{
    protected const CACHE_KEY = 'about:active';

    public function getActive(): ?About
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return About::active()->first();
        });
    }

    public function activate(About $about): void
    {
        DB::transaction(function () use ($about): void {
            About::query()
                ->whereKeyNot($about->getKey())
                ->active()
                ->update(['is_active' => false]);

            $about->update(['is_active' => true]);
        });

        $this->flush();
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
