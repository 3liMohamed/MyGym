<?php

namespace App\View\Components\Sections;

use App\Services\AboutService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\About;
use App\Services\MarqueeItemService;
use Illuminate\Database\Eloquent\Collection;

class AboutSection extends Component
{
    /**
     * Create a new component instance.
     */
    public ?About $about;
    public Collection $items;

    public function __construct(AboutService $about, MarqueeItemService $marqueeItemService, public string $section)
    {
        $this->about = $about->getActive();
        $this->items = $marqueeItemService->getActive();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.about');
    }
}
