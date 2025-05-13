<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    /** @var string */
    public const TABLE_NAME = 'transaction_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'status' => TransactionHistory::class,
    ];
}
