<?php

namespace App\Base\Renter\Listeners;

use App\Base\Renter\Events\BalanceUpdated;
use App\Contracts\QueueableListener;
use App\Models\Enums\BalanceStatus;
use Illuminate\Queue\InteractsWithQueue;

class CheckBalanceStatus extends QueueableListener
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function shouldQueue(BalanceUpdated $event) : bool
    {
        return $event->renter->balance->status->is(BalanceStatus::REQUIRES_MAINTENANCE);
    }

    /**
     * Handle the event.
     */
    public function handle(BalanceUpdated $event) : void
    {
        // Отправляем уведомление админам о том, что при обновлении баланса произошла ошибка.
    }
}
