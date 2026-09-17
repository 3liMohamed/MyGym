<?php

namespace App\Filament\Resources\MarketingItems\Pages;

use App\Filament\Resources\MarketingItems\MarketingItemResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;

class ManageMarketingItems extends ManageRecords
{
    use Translatable;
    protected static string $resource = MarketingItemResource::class;
}
