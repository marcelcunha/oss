<?php

namespace App\Enums;

enum QuoteStatusEnum: string
{
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case REJECTED = 'rejected';

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pendente',
            self::APPROVED => 'Aprovado',
            self::REJECTED => 'Rejeitado',
        };
    }
}
