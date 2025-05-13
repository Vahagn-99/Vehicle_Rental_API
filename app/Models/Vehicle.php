<?php

namespace App\Models;

use App\Base\Vehicle\Location;
use App\Models\Enums\VehicleAvailabilityStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /** @var string */
    public const TABLE_NAME = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'status' => VehicleAvailabilityStatus::class,
        'location' => Location::class,
    ];
}
