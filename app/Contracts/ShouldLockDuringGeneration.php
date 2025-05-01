<?php

namespace App\Contracts;

interface ShouldLockDuringGeneration
{
    /**
     * Получение ключа блокировки доступа к объекту.
     *
     * @param int $id
     * @return string
     */
    public static function getAccessLockKey(int $id) : string;
}