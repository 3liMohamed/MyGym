<?php

namespace App\Models;

use App\Services\SliderService;
use App\Traits\HasAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations, HasAuditLog;

    protected $fillable = [
        'image',
        'title',
        'heading',
        'heading_highlight',
        'button_label',
        'button_url',
        'video_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $translatable = [
        'title',
        'heading',
        'heading_highlight',
        'button_label',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => app(SliderService::class)->flush());
        static::deleted(fn () => app(SliderService::class)->flush());
    }

    public function getImageUrlAttribute(): ?string
    {
        return asset("images/{$this->image}");
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
