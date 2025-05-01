<?php

declare(strict_types=1);


namespace App\Base\Vehicle\Repositories;

use App\Models\Vehicle as VehicleModel;
use App\Contracts\Repository;

class Vehicle extends Repository
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return VehicleModel::class;
    }
}
