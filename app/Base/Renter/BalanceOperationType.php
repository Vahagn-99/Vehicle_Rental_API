<?php

namespace App\Base\Renter;

use App\Support\Traits\HasSupport;

enum BalanceOperationType : int
{
    use HasSupport;

    case INCOME = 1;
    case OUTCOME = 2;
}
