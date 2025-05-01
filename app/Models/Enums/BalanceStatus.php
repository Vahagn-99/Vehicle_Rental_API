<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum BalanceStatus : int
{
    use HasSupport;

    case UNAVAILABLE = 0; // Начальный статус, при создании арендатора у него нет подкюченных карт
    case AVAILABLE = 1;
    case UPDATING = 2;
    case BLOCKED_BY_ADMIN = 3;
    case REQUIRES_MAINTENANCE = 4;
}
