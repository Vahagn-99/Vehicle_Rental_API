<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum VehicleAvailabilityStatus: int
{
    use HasSupport;

    case PREPARING = 0;
    case AVAILABLE = 1;
    case TAKEN = 2;
    case MAINTENANCE = 3;
}
