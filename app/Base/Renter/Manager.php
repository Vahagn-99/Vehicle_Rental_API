<?php

declare(strict_types=1);


namespace App\Base\Renter;

use App\Models\Balance as BalanceModel;
use App\Models\Enums\BalanceStatus;
use App\Base\Renter\Repositories\{
    Renter as RenterRepository,
    TransactionHistory as TransactionHistoryRepository,
    RentalHistory as RentalHistoryRepository,
    Balance as BalanceRepository,
};
use App\Base\Renter\Jobs\UpdateBalance as UpdateBalanceJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Base\Renter\Exceptions\BalanceException;

class Manager
{
    /**
     * @param \App\Base\Renter\Repositories\Renter $renter_repository
     * @param \App\Base\Renter\Repositories\TransactionHistory $transaction_history_repository
     * @param \App\Base\Renter\Repositories\RentalHistory $rental_history_repository
     * @param \App\Base\Renter\Repositories\Balance $balance_repository
     */
    public function __construct(
        protected readonly RenterRepository $renter_repository,
        protected readonly TransactionHistoryRepository $transaction_history_repository,
        protected readonly RentalHistoryRepository $rental_history_repository,
        protected readonly BalanceRepository $balance_repository,
    ) {
        //
    }

    /**
     * Получить историю аренд арендатора.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRentalHistory(int $id) : Collection
    {
        return $this->rental_history_repository->getAllByRenterId($id);
    }

    /**
     * Получить историю операции арендатора.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getOperationsHistory(int $id) : Collection
    {
        return $this->transaction_history_repository->getAllByRenterId($id);
    }

    /**
     * Получить баланс арендатора.
     *
     * @param int $id
     * @return \App\Models\Balance
     */
    public function getBalance(int $id) : BalanceModel
    {
        return $this->balance_repository->getById($id);
    }

    /**
     * Получить баланс арендатора.
     *
     * @param int $renter_id
     * @param \App\Base\Renter\UpdateBalance $update_data
     *
     * @return void
     * @throws \App\Base\Renter\Exceptions\BalanceException
     */
    public function updateBalance(int $renter_id, UpdateBalance $update_data) : void
    {
        $renter = $this->renter_repository->getById($renter_id);

        if (empty($renter)) {
            throw new ModelNotFoundException('Арендатор не найден');
        }

        if ($renter->balance->status !== BalanceStatus::AVAILABLE) {
            throw BalanceException::unavailable($renter->balance->status);
        }

        $renter->balance->status = BalanceStatus::UPDATING;

        UpdateBalanceJob::dispatch($renter, $update_data);
    }
}
