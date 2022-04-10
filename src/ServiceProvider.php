<?php declare(strict_types=1);

namespace Dive\Snowflake;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfig();
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/snowflake.php', 'snowflake');
    }

    private function registerConfig()
    {
        $config = 'snowflake.php';

        $this->publishes([
            __DIR__.'/../config/'.$config => $this->app->configPath($config),
        ], 'config');
    }
}
