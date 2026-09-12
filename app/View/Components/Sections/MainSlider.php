<?php

namespace App\View\Components\Sections;

use App\Services\SliderService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class MainSlider extends Component
{
    public Collection $sliders;


    public function __construct(SliderService $sliderService, public string $section)
    {
        $this->sliders = $sliderService->getActive();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.main-slider');
    }
}
