<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum GymClassDay: int implements HasColor, HasIcon, HasLabel
{
    case Sunday = 1;
    case Monday = 2;
    case Tuesday = 3;
    case Wednesday = 4;
    case Thursday = 5;
    case Friday = 6;
    case Saturday = 7;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Monday => __('days.monday'),
            self::Tuesday => __('days.tuesday'),
            self::Wednesday => __('days.wednesday'),
            self::Thursday => __('days.thursday'),
            self::Friday => __('days.friday'),
            self::Saturday => __('days.saturday'),
            self::Sunday => __('days.sunday'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Friday, self::Saturday => 'warning',
            default => 'primary',
        };
    }

    public function getIcon(): ?string
    {
        return 'heroicon-o-calendar-days';
    }

    public function slug(): string
    {
        return strtolower($this->name);
    }
}
