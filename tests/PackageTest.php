<?php declare(strict_types=1);

namespace Tests;

use Dive\Snowflake\Snowflake as Facade;
use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Schema\Blueprint;
use Tests\Fakes\Product;

test('snowflake facade', function () {
    $value = Facade::id();

    expect($value)->toBeString()->toHaveLength(19);
});

test('snowflake helper', function () {
    $value = snowflake();

    expect($value)->toBeString()->toHaveLength(19);
});

test('service is bound correctly', function () {
    $serviceA = app('snowflake');
    $serviceB = app(Snowflake::class);

    expect($serviceA)
        ->toBeInstanceOf(Snowflake::class)
        ->getSequenceResolver()->toBeInstanceOf(LaravelSequenceResolver::class);
    expect($serviceA)->toBe($serviceB);
});

test('blueprint definitions', function () {
    $blueprint = new Blueprint('tests', static function (Blueprint $table) {
        $table->snowflake();
        $table->foreignSnowflake('user_id');
    });

    expect($blueprint->getColumns())->toBeArray()->toHaveLength(2);
});

test('model trait', function () {
    $productA = Product::create();
    $productB = Product::create(['id' => ($id = 1337133713371337133)]);

    expect($productA->getKey())->toHaveLength(19);
    expect($productB->getKey())->toBe($id);
});
