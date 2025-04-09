<?php

namespace App\View\Components;

use Illuminate\View\Component;

abstract class AbstractInput extends Component
{
    public ?string $name;

    public function getErrorAttribute(): string
    {
        return preg_replace('/\[(.*?)\]/', '.$1', $this->name);
    }
}
