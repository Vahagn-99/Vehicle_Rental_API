<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Contracts\Queue\ShouldQueue;

abstract class QueueableListener implements ShouldQueue
{
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'common';

    /**
     * Запуск слушателя после завершения транзакции в БД.
     *
     * @var bool
     */
    public $afterCommit = true;
}
