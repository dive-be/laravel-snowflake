<?php declare(strict_types=1);

namespace Tests;

use Dive\Snowflake\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Orchestra\Testbench\TestCase as TestCaseBase;

abstract class TestCase extends TestCaseBase
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

    protected function setUpDatabase(Builder $schema): void
    {
        $schema->dropAllTables();

        $schema->create('products', static function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
}
