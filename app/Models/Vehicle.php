<?php

namespace App\Models;

use App\Base\Vehicle\Location;
use App\Models\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'status' => VehicleStatus::class,
        'location' => Location::class,
    ];
}
