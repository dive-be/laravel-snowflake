<?php declare(strict_types=1);

namespace Dive\Snowflake;

use DateTime;
use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfig();
            $this->registerMacros();
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/snowflake.php', 'snowflake');

        $this->app->singleton('snowflake', $this->registerSnowflake(...));
        $this->app->alias('snowflake', Snowflake::class);
    }

    private function registerConfig()
    {
        $config = 'snowflake.php';

        $this->publishes([
            __DIR__ . '/../config/' . $config => $this->app->configPath($config),
        ], 'config');
    }

    private function registerMacros()
    {
        Blueprint::mixin(new SnowflakeDefinitions());
    }

    private function registerSnowflake(Application $app): Snowflake
    {
        $sequence = $app->make(LaravelSequenceResolver::class);
        $start = DateTime::createFromFormat('Y-m-d',
            $app['config']['snowflake.start_date']
        )->getTimestamp();

        return (new Snowflake())->setSequenceResolver($sequence)->setStartTimeStamp($start);
    }
}
