<?php

namespace App\Enums;

enum BookingStatus: int
{
    case confirmed = 0;
    case paid = 1;
    case cancelled = 2;

    public function getName(): string
    {
        return ucfirst($this->name);
    }

    public function getColor(): string
    {
        return match ($this->value) {
            0 => 'text-orange-500',
            1 => 'text-green-500',
            2 => 'text-yellow-500'
        };
    }

}
