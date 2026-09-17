<?php

namespace App\View\Components\Sections;

use App\Services\PostService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Post extends Component
{
    /**
     * Create a new component instance.
     */

    public Collection $posts;

    public function __construct(PostService $postService, string $section)
    {
        $this->posts = $postService->getLatest();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.post');
    }
}
