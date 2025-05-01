<?php

declare(strict_types=1);


namespace App\Base\Auth;

use Spatie\LaravelData\Data;

class AuthData extends Data
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $email,
        public string $password,
    ) {
        //
    }
}
