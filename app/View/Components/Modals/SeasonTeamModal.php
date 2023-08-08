<?php

namespace App\View\Components\Modals;

use App\Models\Team;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SeasonTeamModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Collection $teams
    )
    {
        $this->teams->ensure(Team::class);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.season-team-modal');
    }
}
