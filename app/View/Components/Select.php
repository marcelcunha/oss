<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public ?string $name = null,
        public ?string $id = null,
        public string $placeholder = '',
        public Collection|array  $options = [],
        public ?string $parentClass = null,
        public ?string $value = null,
    ) {
        $this->name = $this->name ?? Str::snake($this->label);
        $this->id = $this->id ?? $this->name;

        if($this->options instanceof Collection) {
            $this->options = $this->options->toArray();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
