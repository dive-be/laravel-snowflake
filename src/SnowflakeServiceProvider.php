<?php declare(strict_types=1);

namespace Dive\Snowflake;

use DateTime;
use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class SnowflakeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->registerConfig();
            $this->registerMacros();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/snowflake.php', 'snowflake');

        $this->app->singleton('snowflake', $this->registerSnowflake(...));
        $this->app->alias('snowflake', Snowflake::class);
    }

    private function registerConfig(): void
    {
        $config = 'snowflake.php';

        $this->publishes([
            __DIR__ . '/../config/' . $config => $this->app->configPath($config),
        ], 'config');
    }

    private function registerMacros(): void
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
