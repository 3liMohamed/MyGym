<?php

namespace App\Filament\Resources\ChooseUs\Pages;

use App\Filament\Resources\ChooseUs\ChooseUsResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;

class ManageChooseUs extends ManageRecords
{
    use Translatable;
    protected static string $resource = ChooseUsResource::class;
}
