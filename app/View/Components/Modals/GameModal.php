<?php

namespace App\View\Components\Modals;

use App\Models\Season;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GameModal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Season $season
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.game-modal');
    }
}
