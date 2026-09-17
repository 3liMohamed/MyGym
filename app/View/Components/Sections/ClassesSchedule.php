<?php

namespace App\View\Components\Sections;

use App\Enums\GymClassDay;
use App\Models\CtaSection;
use App\Services\CtaSectionService;
use App\Services\GymClassService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ClassesSchedule extends Component
{
    public Collection $classesByDay;
    public ?CtaSection $cta;

    /**
     * @var GymClassDay[]
     */
    public array $activeDays;
    public function __construct(GymClassService $gymClassService, CtaSectionService $ctaSectionService, public string $section)
    {
        $this->classesByDay = $gymClassService->getGroupedByDay();
        $this->activeDays = collect(GymClassDay::cases())
            ->filter(fn (GymClassDay $day) => $this->classesByDay->get($day->value, collect())->isNotEmpty())
            ->values()
            ->all();
        $this->cta = $ctaSectionService->getActive();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('sections.classes-schedule');
    }
}
