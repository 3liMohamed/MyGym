<?php

namespace App\Filament\Resources\MarqueeItems\Pages;

use App\Filament\Resources\MarqueeItems\MarqueeItemResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;

class ManageMarqueeItems extends ManageRecords
{
    use Translatable;
    protected static string $resource = MarqueeItemResource::class;

}
