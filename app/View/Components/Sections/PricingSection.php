<?php

namespace App\View\Components\Sections;

use App\Models\ChooseUs;
use App\Services\ChooseUsService;
use App\Services\MarketingItemService;
use App\Services\PricingPlanService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PricingSection extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $plans;
    public Collection $marketingItem;
    public ?ChooseUs $choose;

    public function __construct(PricingPlanService $pricingPlanService, MarketingItemService $marketingItemService, ChooseUsService $chooseUsService, public string $section)
    {
        $this->plans = $pricingPlanService->getActive();
        $this->marketingItem = $marketingItemService->getActive();
        $this->choose = $chooseUsService->getActive();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.pricing-section');
    }
}
