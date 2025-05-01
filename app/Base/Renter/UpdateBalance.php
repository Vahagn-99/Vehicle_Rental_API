<?php

declare(strict_types=1);


namespace App\Base\Renter;

use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class UpdateBalance extends Data
{
    /**
     * @param float $amount
     * @param \App\Base\Renter\BalanceOperationType $operation_type
     */
    public function __construct(
        public float $amount,
        #[WithCast(EnumCast::class)]
        public BalanceOperationType $operation_type,
    ) {
        //
    }
}
