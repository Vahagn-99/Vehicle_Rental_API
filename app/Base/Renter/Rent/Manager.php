<?php

declare(strict_types=1);


namespace App\Base\Renter\Rent;

use App\Base\Renter\Rent\Repositories\Rent as RentRepository;
use App\Base\Renter\Repositories\Renter as RenterRepository;
use App\Base\Vehicle\Repositories\Vehicle as VehicleRepository;

class Manager
{
    /**
     * @param \App\Base\Renter\Rent\Repositories\Rent $renter_repository
     * @param \App\Base\Renter\Repositories\Renter $rent_repository
     * @param \App\Base\Vehicle\Repositories\Vehicle $vehicle_repository
     */
    public function __construct(
        private readonly RentRepository $renter_repository,
        private readonly RenterRepository $rent_repository,
        private readonly VehicleRepository $vehicle_repository,
    ) {
        //
    }

    /**
     * Аренда ТС
     *
     * @param int $id
     * @param int $vehicle_id
     */
    public function rent(int $id, int $vehicle_id)
    {
        $this->renter_repository->checkCanRentVehicle($id, $vehicle_id);
    }
}
