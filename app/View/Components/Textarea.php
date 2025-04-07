<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Textarea extends AbstractInput
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public ?string $name = null,
        public ?string $id = null,
        public ?string $parentClass = null,
        public bool $required = false,
    ) {
        $this->name = $this->name ?? Str::snake($this->label);
        $this->id = $this->id ?? $this->name;

        if($required){
            $this->label = $this->label . ' *';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
