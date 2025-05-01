<?php

namespace App\Models;

use App\Models\Enums\RentalHistoryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'status' => RentalHistoryStatus::class,
    ];
}
