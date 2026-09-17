<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PostService
{
    protected const CACHE_KEY_LATEST = 'posts:latest';
    protected const MAX_PUBLISHED = 2;


    public function getLatest(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY_LATEST, function () {
            return Post::published()->get();
        });
    }

    public function togglePublished(Post $post, bool $publish): bool
    {
        if ($publish && $this->publishedCount(excluding: $post) >= self::MAX_PUBLISHED) {
            return false;
        }

        $post->update([
            'is_published' => $publish,
            'published_at' => $publish ? now() : null,
        ]);

        return true;
    }

    public function publishedCount(?Post $excluding = null): int
    {
        return Post::query()
            ->published()
            ->when($excluding, fn($query) => $query->whereKeyNot($excluding->getKey()))
            ->count();
    }

    public function maxPublished(): int
    {
        return self::MAX_PUBLISHED;
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY_LATEST);
    }
}
