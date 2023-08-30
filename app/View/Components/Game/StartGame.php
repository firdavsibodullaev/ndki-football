<?php

namespace App\View\Components\Game;

use App\Models\Game;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StartGame extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Game $game
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game.start-game');
    }
}
