<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleType: string
{
    case ADMIN = 'admin';

    case VENDOR = 'vendor';

    case CLIENT = 'client';
}
