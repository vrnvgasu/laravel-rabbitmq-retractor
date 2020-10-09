<?php

namespace Vrnvgasu\RebbitMqRetractor\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Trait Logger
 * @package Vrnvgasu\RebbitMqRetractor\Helpers
 */
trait Logger
{
    /**
     * @param Exception $e
     */
    private function logError(Exception $e): void
    {
        if (!($logger = config('rabbitmq_retractor.logger'))) {
            return;
        }

        Log::channel($logger)->error([
            'File' => $e->getFile(),
            'Line' => $e->getLine(),
            'Message' => $e->getMessage(),
            'Attempts left' => $this->retractorAttempt - 1,
        ]);
    }
}
