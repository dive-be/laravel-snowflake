<?php declare(strict_types=1);

namespace Dive\Snowflake;

use Closure;
use Illuminate\Database\Schema\Blueprint;

/** @mixin Blueprint */
final class SnowflakeDefinitions
{
    public function foreignSnowflake(): Closure
    {
        return fn (string $column) => $this->foreignId($column);
    }

    public function snowflake(): Closure
    {
        return fn (string $column = 'id') => $this->unsignedBigInteger($column)->primary();
    }
}
