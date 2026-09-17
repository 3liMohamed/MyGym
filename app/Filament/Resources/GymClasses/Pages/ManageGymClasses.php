<?php

namespace App\Filament\Resources\GymClasses\Pages;

use App\Filament\Resources\GymClasses\GymClassResource;
use Filament\Resources\Pages\ManageRecords;
use LaraZeus\SpatieTranslatable\Resources\Pages\ManageRecords\Concerns\Translatable;

class ManageGymClasses extends ManageRecords
{
    use Translatable;
    protected static string $resource = GymClassResource::class;

}
