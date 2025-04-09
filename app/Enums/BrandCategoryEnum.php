<?php

namespace App\Enums;

enum BrandCategoryEnum: string
{
    case CPU = 'cpu';
    case DESKTOP = 'desktop';
    case GPU = 'gpu';
    case LAPTOP = 'laptop';
    case MOTHERBOARD = 'mobo';
    case POWERSUPPLY = 'psuply';
    case RAM = 'ram';
    case STORAGE = 'storage';

    public function label(): string
    {
        return match ($this) {
            self::CPU => 'Processador',
            self::GPU => 'Placa de Vídeo',
            self::MOTHERBOARD => 'Placa Mãe',
            self::RAM => 'Memória RAM',
            self::STORAGE => 'Armazenamento',
            self::LAPTOP => 'Notebook',
            self::DESKTOP => 'Desktop',
            self::POWERSUPPLY => 'Fonte',
        };
    }
}
