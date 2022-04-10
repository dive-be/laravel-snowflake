<?php declare(strict_types=1);

namespace Tests;

use Dive\Snowflake\Snowflake as Facade;
use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Database\Schema\Blueprint;
use Tests\Fakes\Post;

test('snowflake facade', function () {
    $value = Facade::id();

    expect($value)->toBeString()->toHaveLength(19);
});

test('snowflake helper', function () {
    $value = snowflake();

    expect($value)->toBeString()->toHaveLength(19);
});

test('service is bound correctly', function () {
    $service = app('snowflake');

    expect($service)
        ->toBeInstanceOf(Snowflake::class)
        ->getSequenceResolver()->toBeInstanceOf(LaravelSequenceResolver::class);
});

test('blueprint definitions', function () {
    $blueprint = new Blueprint('tests', static function (Blueprint $table) {
        $table->snowflake();
        $table->foreignSnowflake('user_id');
    });

    expect($blueprint->getColumns())->toBeArray()->toHaveLength(2);
});

test('model trait', function () {
    $postA = Post::create();
    $postB = Post::create(['id' => ($id = 1337133713371337133)]);

    expect($postA->getKey())->toHaveLength(19);
    expect($postB->getKey())->toBe($id);
});
