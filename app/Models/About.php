<?php

namespace App\Models;

use App\Services\AboutService;
use App\Traits\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;

class About extends Model
{
    use HasTranslations, HasAuditLog;
    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'description',
        'paragraph',
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
        'sub_title',
        'description',
        'paragraph',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => app(AboutService::class)->flush());
        static::deleted(fn () => app(AboutService::class)->flush());
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
