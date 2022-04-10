<?php declare(strict_types=1);

namespace Tests\Fakes;

use Dive\Snowflake\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasSnowflakes;
}
