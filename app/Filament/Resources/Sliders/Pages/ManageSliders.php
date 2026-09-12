<?php

namespace App\Filament\Resources\Sliders\Pages;

use App\Filament\Resources\Sliders\SliderResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;

class ManageSliders extends ManageRecords
{
    use Translatable;
    protected static string $resource = SliderResource::class;

}
