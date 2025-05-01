<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum UserStatus: int
{
    use HasSupport;

    case ACTIVE = 0;
    case INACTIVE = 1;
    case BANNED = 2;
}
