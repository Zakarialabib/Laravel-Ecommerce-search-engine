<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleType: string
{
    case ADMIN = 'ADMIN';

    case VENDOR = 'VENDOR';

    case CLIENT = 'CLIENT';
}
