<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PricingPeriod: int implements HasColor, HasIcon, HasLabel
{
    case Month = 1;
    case Year = 2;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Month => __('system.pricing.month'),
            self::Year => __('system.pricing.year'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Month => 'gray',
            self::Year => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Month => 'heroicon-o-calendar-days',
            self::Year => 'heroicon-o-calendar',
        };
    }
}
