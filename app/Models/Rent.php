<?php

namespace App\Models;

use App\Models\Enums\RentStatus;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'status' => RentStatus::class
    ];
}
