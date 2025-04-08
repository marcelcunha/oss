<?php

namespace App\Enums;

enum DeviceTypeEnum: string
{
    case DESKTOP = 'desktop';
    case LAPTOP = 'laptop';
    case MOBILE = 'mobile';
    case ROUTER = 'router';
    case TABLET = 'tablet';

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
