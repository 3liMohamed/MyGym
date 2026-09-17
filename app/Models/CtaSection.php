<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class CtaSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image',
        'small_title',
        'big_title',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public array $translatable = [
        'small_title',
        'big_title',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CtaSectionItem::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return asset("images/{$this->image}");
    }
}
