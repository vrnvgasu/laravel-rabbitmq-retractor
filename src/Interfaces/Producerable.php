<?php

namespace Vrnvgasu\RebbitMqRetractor\Interfaces;

/**
 * Interface Producerable
 * @package Vrnvgasu\RebbitMqRetractor\Interfaces
 */
interface Producerable
{
    /**
     * @param string $message
     * @return mixed
     */
    public function handle(string $message);
}
