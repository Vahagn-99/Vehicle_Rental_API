<?php

namespace App\Base\Renter\Exceptions;

use App\Models\Enums\BalanceStatus;
use Exception;

class BalanceException extends Exception
{
    /**
     * Исключение, возникающее при ошибках, связанных с балансом арендатора.
     *
     * @param \App\Models\Enums\BalanceStatus $status
     * @return \App\Base\Renter\Exceptions\BalanceException
     */
    public static function unavailable(BalanceStatus $status) : BalanceException
    {
        return match ($status) {
            BalanceStatus::REQUIRES_MAINTENANCE => new static("Баланс требует обслуживания. Пожалуйста, обратитесь в службу поддержки."),
            BalanceStatus::UPDATING => new static("Баланс уже обновляется."),
            BalanceStatus::BLOCKED_BY_ADMIN => new static("Баланс заблокирован администратором. Пожалуйста, обратитесь в службу поддержки."),
            default => new static("Система не может обновить баланс."),
        };
    }
}
