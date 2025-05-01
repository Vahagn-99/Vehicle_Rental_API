<?php

declare(strict_types=1);


namespace App\Base\Renter\Repositories;

use App\Contracts\Repository;
use App\Models\Balance as BalanceModel;

class Balance extends Repository
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return BalanceModel::class;
    }

    /**
     * Получить баланс арендатора по ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getById(int $id) : ?BalanceModel
    {
        return $this->query()->find($id);
    }
}
