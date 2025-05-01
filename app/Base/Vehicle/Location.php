<?php

declare(strict_types=1);


namespace App\Base\Vehicle;

use Spatie\LaravelData\Data;

class Location extends Data
{
    /**
     * Create a new Location instance.
     *
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude,
    ) {
        //
    }
}
