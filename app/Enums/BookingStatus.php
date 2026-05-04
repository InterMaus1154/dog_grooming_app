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
            2 => 'text-red-500'
        };
    }

    public function getCSSColor(): string
    {
        return match ($this->value) {
            0 => 'oklch(55.3% 0.195 38.402)',
            1 => 'oklch(52.7% 0.154 150.069)',
            2 => 'oklch(50.5% 0.213 27.518)'
        };
    }

    public function getBadgeColor(): string
    {
        return match ($this->value) {
            0 => 'orange',
            1 => 'green',
            2 => 'red'
        };
    }

}
