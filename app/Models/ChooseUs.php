<?php

namespace App\Models;

use App\Services\ChooseUsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ChooseUs extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image',
        'title',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public array $translatable = [
        'title',
        'description',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ChooseUsItems::class)->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return asset("images/{$this->image}");
    }

    protected static function booted(): void
    {
        static::saved(fn () => app(ChooseUsService::class)->flush());
        static::deleted(fn () => app(ChooseUsService::class)->flush());
    }
}
