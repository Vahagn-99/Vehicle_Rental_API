<?php

declare(strict_types=1);


namespace App\Base\Renter\Rent\Repositories;

use App\Contracts\Repository;
use App\Models\Rent as RentModel;

class Rent extends Repository
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return RentModel::class;
    }

    /**
     * Получить арендатора по ID.
     *
     * @param int $renter_id
     * @param int|null $vehicle_id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getForRenter(int $renter_id, ?int $vehicle_id) : ?RentModel
    {
        return $this->query()
            ->where('renter_id', $renter_id)
            ->when(isset($vehicle_id), fn($query) => $query->where('vehicle_id', $vehicle_id));
    }
}
