<?php

namespace App\Enums;

enum RoleEnum: string
{
    public const ADMIN = 'admin';
    public const ASSISTANT = 'assistant';
    public const CLIENT = 'client';
}