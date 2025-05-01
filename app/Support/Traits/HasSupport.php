<?php

namespace App\Support\Traits;

trait HasSupport
{
    /**
     * Get a random case from the enum.
     *
     * @return static
     */
    public static function random() : self
    {
        $count = count(self::cases()) - 1;

        return self::cases()[rand(0, $count)];
    }

    /**
     * Check if the current case is equal to the given case.
     *
     * @param $case
     *
     * @return bool
     */
    public function is(mixed $case) : bool
    {
        return $this === $case;
    }
}