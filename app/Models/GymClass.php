<?php

namespace App\Models;

use App\Enums\GymClassDay;
use App\Services\GymClassService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GymClass extends Model
{
    use HasTranslations;

    protected $fillable = [
        'day',
        'name',
        'start_time',
        'end_time',
        'instructor',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'day' => GymClassDay::class,
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'is_active' => 'boolean',
        ];
    }

    public array $translatable = [
        'name',
        'instructor',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeForDay(Builder $query, GymClassDay $day): Builder
    {
        return $query->where('day', $day);
    }

    public function getTimeRangeAttribute(): ?string
    {
        if (! $this->start_time || ! $this->end_time) {
            return null;
        }

        return $this->start_time->format('g:i A') . ' - ' . $this->end_time->format('g:i A');
    }

    protected static function booted(): void
    {
        static::saved(fn() => app(GymClassService::class)->flush());
        static::deleted(fn() => app(GymClassService::class)->flush());
    }
}
