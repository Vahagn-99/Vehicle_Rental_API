<?php

namespace App\Base\Renter\Jobs;

use App\Models\{
    Balance as BalanceModel,
    Enums\BalanceStatus,
    User as RenterModel,
};
use App\Base\Renter\{
    BalanceOperationType,
    Events\BalanceUpdated,
    UpdateBalance as UpdateBalanceDto};
use Cache;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class UpdateBalance implements ShouldBeUniqueUntilProcessing
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly RenterModel $renter,
        private readonly UpdateBalanceDto $data
    ) {
        $this->onQueue('balance_updating');
    }

    /**
     * Execute the job.
     */
    public function handle() : void
    {
        $renter_balance = $this->renter->balance;

        $lock_key = BalanceModel::getAccessLockKey($renter_balance->id);

        $lock = Cache::lock($lock_key, 60);

        try {
            $lock->block(10);

            if ($this->data->operation_type->is(BalanceOperationType::INCOME)) {
                $renter_balance->total += $this->data->amount;
            } else {
                $renter_balance->total -= $this->data->amount;
            }

            $renter_balance->status = BalanceStatus::AVAILABLE;

            $renter_balance->save();

            BalanceUpdated::dispatch($this->renter);
        } catch (LockTimeoutException) {
            alt_log()->file("error_during_balance_updating")->error("Получение блокировки для обновления баланса арендатора {$this->renter->id}", $this->data->toArray());

            $this->release(10);
        } catch (Throwable $e) {
            alt_log()->file("critical_error_during_balance_updating")->critical("Ошибка при обновлении баланса арендатора {$this->renter->id}. Ошибка: {$e->getMessage()}", $this->data->toArray());

            $renter_balance->status = BalanceStatus::REQUIRES_MAINTENANCE;

            $renter_balance->save();

            BalanceUpdated::dispatch($this->renter);
        } finally {
            $lock->release();
        }
    }

    /**
     * Get the unique ID for the job.
     *
     * @return int
     */
    public function uniqueId() : int
    {
        return $this->renter->id;
    }
}
