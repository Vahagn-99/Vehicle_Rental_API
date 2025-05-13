<?php

namespace App\Models\Enums;

use App\Support\Traits\HasSupport;

enum RentStatus : int
{
    use HasSupport;

    case ORDER_ACCEPTED = 1;
    case ON_THE_WAY = 2;
    case RENTAL = 3;
    case START_DRIVING = 4;
    case DRIVING = 5;
    case RENT_OUT = 6;
}
