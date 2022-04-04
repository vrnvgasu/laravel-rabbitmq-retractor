<?php

namespace Vrnvgasu\RebbitMqRetractor\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RetractProvider
 * @package Vrnvgasu\RebbitMqRetractor\Providers
 */
class RetractProvider extends ServiceProvider
{
    public const ROOT_PATH = __DIR__ . '/../../';

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            static::ROOT_PATH . 'config/rabbitmq_retractor.php' => config_path('rabbitmq_retractor.php'),
        ], 'retractor');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
