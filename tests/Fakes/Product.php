<?php declare(strict_types=1);

namespace Tests\Fakes;

use Dive\Snowflake\HasSnowflake;
use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    use HasSnowflake;
}
