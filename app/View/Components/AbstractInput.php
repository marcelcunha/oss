<?php

namespace App\View\Components;

use Illuminate\View\Component;
use RuntimeException;

abstract class AbstractInput extends Component
{
    public ?string $name;

    public function getErrorAttribute(): string
    {
        if (is_null($this->name)) {
            throw new RuntimeException("Name attribute is not set for: {$this->name}!");
        }
        
        $result = preg_replace('/\[(.*?)\]/', '.$1', $this->name);

        if (is_null($result)) {
            throw new RuntimeException("Error processing regular expression for: {$this->name}!");
        }

        return $result;
    }
}
