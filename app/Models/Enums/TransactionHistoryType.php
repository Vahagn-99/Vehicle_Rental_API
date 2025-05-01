<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum TransactionHistoryType: int
{
    use HasSupport;

    case REFILL = 0;
    case CHARGE = 1;
    case REFUND = 2;
}
