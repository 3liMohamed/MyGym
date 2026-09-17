<?php

namespace App\Filament\Resources\CtaSections\Pages;

use App\Filament\Resources\CtaSections\CtaSectionResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;

class ManageCtaSections extends ManageRecords
{
    use Translatable;
    protected static string $resource = CtaSectionResource::class;
}
