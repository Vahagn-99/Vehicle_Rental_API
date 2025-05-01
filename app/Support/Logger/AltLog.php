<?php

declare(strict_types=1);

namespace App\Support\Logger;

use Exception;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

class AltLog
{
    private string $prefix;

    /**
     * Создает экземпляр логгера с заданным именем файла.
     *
     * @param string $file
     * @return \Psr\Log\LoggerInterface
     */
    public function file(string $file) : LoggerInterface
    {
        $file .= '_'.date('Y-m-d');

        if (! empty($this->prefix)) {
            $file = $this->prefix.$file;
        }

        return Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$file.'.log'),
        ]);
    }

    /**
     * Устанавливает префикс для имени файла.
     *
     * @param string $name
     * @return $this
     *
     * @throws \Exception
     */
    public function tag(string $name) : AltLog
    {
        $tags = config("logging.tags");

        $tag = $tags[$name] ?? null;

        if (empty($tag)) {
            throw new Exception("Тег: {$name} не настроены в конфигурации.");
        }

        $tag = [$name] ?? null;

        $this->prefix = $tag['prefix'];

        return $this;
    }
}
