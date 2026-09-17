<?php

namespace App\Services;

use App\Models\CtaSection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CtaSectionService
{
    protected const CACHE_KEY = 'cta_section:active';

    public function getActive(): ?CtaSection
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return CtaSection::query()
                ->active()
                ->with('items')
                ->first();
        });
    }

    public function activate(CtaSection $about): void
    {
        DB::transaction(function () use ($about): void {
            CtaSection::query()
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
