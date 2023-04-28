<?php declare(strict_types=1);

namespace Dive\Snowflake;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string id()
 * @method static array  parseId(string $id, bool $transform = false)
 *
 * @see \Godruoyi\Snowflake\Snowflake
 */
final class Snowflake extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'snowflake';
    }
}
