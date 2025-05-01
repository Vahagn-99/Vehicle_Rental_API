<?php


use App\Support\Logger\AltLog;

if (! function_exists('alt_log')) {
    function alt_log() : AltLog
    {
        return new AltLog();
    }
}