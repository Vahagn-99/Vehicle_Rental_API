<?php

namespace App\Models;

use App\Models\Enums\ModelBodyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasFactory;

    protected $casts = [
        'body_type' => ModelBodyType::class,
    ];
}
