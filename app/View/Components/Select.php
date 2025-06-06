<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Select extends AbstractInput
{
    /**
     * Create a new component instance.
     *
     * @param  Collection<int,string>|array<int,string>  $options
     */
    public function __construct(
        public string $label,
        public ?string $name = null,
        public ?string $id = null,
        public string $placeholder = 'Selecione',
        public Collection|array $options = [],
        public ?string $parentClass = null,
        public ?string $value = null,
        public bool $required = false,
    ) {
        $this->name = $this->name ?? Str::snake($this->label);
        $this->id = $this->id ?? preg_replace('/\[(.*?)\]/', '_$1', $this->name);

        if ($this->options instanceof Collection) {
            $this->options = $this->options->toArray();
        }

        if ($this->required) {
            $this->label = $this->label.' *';
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
