<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum ModelBodyType: int
{
    use HasSupport;

    case HATCHBACK = 0;
    case SEDAN = 1;
    case SUV = 2;
}
