<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum DeliveryStatus: int
{
    use HasSupport;

    case Preparing = 0;
    case Available = 1;
    case Taken = 2;
    case Maintenance = 3;
}
