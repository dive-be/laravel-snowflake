<?php declare(strict_types=1);

namespace Tests;

use Dive\Snowflake\Snowflake as Facade;
use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Schema\Blueprint;
use PHPUnit\Framework\Attributes\Test;
use Tests\Fakes\Product;

final class PackageTest extends TestCase
{
    #[Test]
    public function snowflake_facade(): void
    {
        $value = Facade::id();

        $this->assertIsString($value);
        $this->assertSame(19, strlen($value));
    }

    #[Test]
    public function snowflake_helper(): void
    {
        $value = snowflake();

        $this->assertIsString($value);
        $this->assertSame(19, strlen($value));
    }

    #[Test]
    public function service_is_bound_correctly(): void
    {
        $serviceA = app('snowflake');
        $serviceB = app(Snowflake::class);

        $this->assertInstanceOf(Snowflake::class, $serviceA);
        $this->assertInstanceOf(LaravelSequenceResolver::class, $serviceA->getSequenceResolver());
        $this->assertSame($serviceA, $serviceB);
    }

    #[Test]
    public function blueprint_definitions(): void
    {
        $blueprint = new Blueprint('tests', static function (Blueprint $table) {
            $table->snowflake();
            $table->foreignSnowflake('user_id');
        });

        $this->assertCount(2, $blueprint->getColumns());
    }

    #[Test]
    public function model_trait(): void
    {
        $productA = Product::create();
        $productB = Product::create(['id' => ($id = 1337133713371337133)]);

        $this->assertIsString($productA->getKey());
        $this->assertSame(19, strlen($productA->getKey()));
        $this->assertEquals($id, $productB->getKey());
    }
}
