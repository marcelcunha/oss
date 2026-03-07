<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;

class QuoteDTO implements Arrayable
{
    public function __construct(
        public string $quote_date,
        public int $client_id,
        public int $device_id,
        public array $items,
        public ?string $notes = null
    ): void {}

    public function toArray(): array
    {
        return [
            'quote_date' => $this->quote_date,
            'client_id' => $this->client_id,
            'device_id' => $this->device_id,
            'notes' => $this->notes,
        ];
    }
}
