<?php

namespace App\Base\Vehicle;

use App\Base\Vehicle\Repositories\Vehicle as VehicleRepository;
use App\Models\Enums\VehicleAvailabilityStatus;
use App\Models\Vehicle as VehicleModel;
use Illuminate\Database\Eloquent\Collection;

class Manager
{
    /**
     * @param \App\Base\Vehicle\Repositories\Vehicle $vehicle_repository
     */
    public function __construct(
        protected readonly VehicleRepository $vehicle_repository,
    ) {
        //
    }

    /**
     * Получить все доступные автомобили.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAvailableItems() : Collection
    {
        return $this->vehicle_repository
            ->getBuilder()
            ->where("status", VehicleAvailabilityStatus::AVAILABLE)
            ->get();
    }

    /**
     * Получить автомобиль по ID.
     *
     * @param int $id
     * @return \App\Models\Vehicle|null
     */
    public function getById(int $id) : ?VehicleModel
    {
        return $this->vehicle_repository->get($id);
    }

    /**
     * Обновляет статус автомобиля.
     *
     * @param int $vehicle_id
     * @param \App\Models\Enums\VehicleAvailabilityStatus $status
     * @return VehicleModel
     */
    public function updateStatus(int $vehicle_id, VehicleAvailabilityStatus $status) : VehicleModel
    {
        /** @var VehicleModel $vehicle */
        $vehicle = $this->vehicle_repository->get($vehicle_id);

        $vehicle->status = $status;

        $vehicle->save();

        return $vehicle;
    }

    /**
     * Обновляет координаты автомобиля.
     *
     * @param int $vehicle_id
     * @param \App\Base\Vehicle\Location $location
     * @return \App\Models\Vehicle
     */
    public function updateLocation(int $vehicle_id, Location $location) : VehicleModel
    {
        /** @var VehicleModel $vehicle */
        $vehicle = $this->vehicle_repository->get($vehicle_id);

        $vehicle->location = $location;

        $vehicle->save();

        return $vehicle;
    }
}
