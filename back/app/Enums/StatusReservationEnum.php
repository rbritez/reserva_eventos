<?php

namespace App\Enums;

enum StatusReservationEnum: string
{
    case PENDING = 'pendiente';
    case CONFIRMED = 'confirmado';
    case CANCELED = 'cancelado';
    case COMPLETED = 'completado';
    case NO_SHOW  = 'no utilizado';

    public static function statusArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}