<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case ASSISTANT = 'assistant';
    case CLIENT = 'client';

    public static function rolesArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}