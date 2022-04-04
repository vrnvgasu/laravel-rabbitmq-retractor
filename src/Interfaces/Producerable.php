<?php

namespace Vrnvgasu\RebbitMqRetractor\Interfaces;

/**
 * Interface Producerable
 * @package Vrnvgasu\RebbitMqRetractor\Interfaces
 */
interface Producerable
{
    /**
     * @return mixed
     */
    public function handle(string $message);
}
