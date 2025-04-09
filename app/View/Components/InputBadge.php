<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class InputBadge extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  list<string>  $items
     */
    public function __construct(public string $label, public ?string $name, public ?string $id, public ?string $parentClass = null, public array $items = [])
    {
        $this->name = $this->name ?? Str::snake($this->label);
        $this->id = $this->id ?? $this->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-badge');
    }
}
