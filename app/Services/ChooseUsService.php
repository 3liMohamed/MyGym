<?php

namespace App\Services;

use App\Models\ChooseUs;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ChooseUsService
{
    protected const CACHE_KEY = 'choose_section:active';

    public function getActive(): ?ChooseUs
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return ChooseUs::query()
                ->active()
                ->with('items')
                ->first();
        });
    }

    public function activate(ChooseUs $choose): void
    {
        DB::transaction(function () use ($choose): void {
            ChooseUs::query()
                ->whereKeyNot($choose->getKey())
                ->active()
                ->update(['is_active' => false]);

            $choose->update(['is_active' => true]);
        });

        $this->flush();
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
