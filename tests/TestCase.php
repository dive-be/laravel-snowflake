<?php declare(strict_types=1);

namespace Tests;

use Dive\Snowflake\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app['db.schema']);

        Model::unguard();
    }

    protected function setUpDatabase(Builder $schema)
    {
        $schema->dropAllTables();

        $schema->create('products', static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
