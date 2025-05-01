<?php

declare(strict_types=1);


namespace App\Base\Renter\Repositories;

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
}
