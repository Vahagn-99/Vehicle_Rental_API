<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum RentalHistoryStatus : int
{
    use HasSupport;

    case ACTIVE = 0;
    case COMPLETED = 1;
    case CANCELED = 2;
}
