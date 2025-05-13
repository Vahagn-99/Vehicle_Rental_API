<?php

declare(strict_types=1);


namespace App\Base\Auth;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class AuthData extends Data
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        #[Rule(["required", "exists:users,email"])]
        public string $email,
        #[Rule(["required"])]
        public string $password,
    ) {
        //
    }
}
