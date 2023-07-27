<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string  $text,
        public string  $name,
        public ?Media  $file = null,
        public ?string $id = null,
        public bool    $isRequired = false,
    )
    {
        $this->file = $this->file?->exists ? $this->file : null;

        $this->id = $this->id ?: $this->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public
    function render(): View|Closure|string
    {
        return view('components.form.image-input');
    }
}
