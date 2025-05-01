<?php

declare(strict_types=1);


namespace App\Base\Renter\Repositories;

use App\Models\RentalHistory as RentalHistoryModel;
use App\Contracts\Repository;
use Illuminate\Database\Eloquent\Collection;

class RentalHistory extends Repository
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return RentalHistoryModel::class;
    }

    /**
     * Получить историю аренды арендатора по ID.
     *
     * @param int $renter_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllByRenterId(int $renter_id) : Collection
    {
        /** @var \Illuminate\Database\Eloquent\Collection */
        return $this->query()
            ->where('renter_id', $renter_id)
            ->get();
    }
}
