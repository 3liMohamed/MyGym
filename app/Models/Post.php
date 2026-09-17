<?php

namespace App\Models;

use App\Services\PostService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image',
        'category',
        'title',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public array $translatable = [
        'category',
        'title',
    ];

    protected static function booted(): void
    {
        static::saved(fn() => app(PostService::class)->flush());
        static::deleted(fn() => app(PostService::class)->flush());
    }


    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at');
    }


    public function getImageUrlAttribute(): string
    {
        return Storage::disk('images')->url($this->image);
    }
}
