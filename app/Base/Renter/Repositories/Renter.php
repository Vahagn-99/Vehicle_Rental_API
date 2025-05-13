<?php

declare(strict_types=1);


namespace App\Base\Renter\Repositories;

use App\Models\Enums\UserStatus;
use App\Models\User as RenterModel;
use App\Contracts\Repository;

class Renter extends Repository
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return RenterModel::class;
    }

    /**
     * Получить арендатора по ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getById(int $id) : ?RenterModel
    {
        return $this->query()->find($id);
    }

    /**
     * Получить арендатора по ID.
     *
     * @param int $id
     * @param int $vehicle_id
     * @return void
     */
    public function checkCanRentVehicle(int $id, int $vehicle_id)
    {
        $this->query()->join(RenterModel::TABLE_NAME, 'renters.id', '=', 'vehicles.renter_id');
    }

    /**
     * Проверка есть ли пользователь по почте.
     *
     * @param string $email
     * @return bool
     */
    public function existsByEmail(string $email) : bool
    {
        return $this->query()
            ->where("email", $email)
            ->exists();
    }
}
