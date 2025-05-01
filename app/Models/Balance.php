<?php

namespace App\Models;

use App\Contracts\ShouldLockDuringGeneration;
use App\Models\Enums\BalanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model implements ShouldLockDuringGeneration
{
    /** @use HasFactory<\Database\Factories\BalanceFactory> */
    use HasFactory;

    protected $casts = [
        'status' => BalanceStatus::class,
    ];

    public static function getAccessLockKey(int $id) : string
    {
        return "balance_".$id.'_lock';
    }
}
