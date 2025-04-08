<?php

namespace App\Enums;

enum DeviceTypeEnum: string
{
    case MOBILE = 'mobile';
    case TABLET = 'tablet';
    case DESKTOP = 'desktop';
    case LAPTOP = 'laptop';
    case ROUTER = 'router';

    public function label(): string
    {
        return match ($this) {
            self::MOBILE => 'Celular',
            self::TABLET => 'Tablet',
            self::DESKTOP => 'Desktop',
            self::LAPTOP => 'Notebook',
            self::ROUTER => 'Roteador',
        };
    }

    
}
