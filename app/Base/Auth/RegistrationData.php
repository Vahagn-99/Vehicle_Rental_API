<?php

declare(strict_types=1);


namespace App\Base\Auth;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class RegistrationData extends Data
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $password_confirmation
     * @param string $gender
     */
    public function __construct(
        #[Rule(["required", "string", "min:4", "max:50"])]
        public string $name,
        #[Rule(["required", "email:rfc,dns,filter", "unique:users,email"])]
        public string $email,
        #[Rule(["required", "confirmed", "min:8", "max:255"])]
        public string $password,
        #[Rule(["required", "same:password"])]
        public string $password_confirmation,
        #[Rule(["required"])]
        public string $gender,
    ) {
        //
    }
}
