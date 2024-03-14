<?php declare(strict_types=1);

namespace Dive\Snowflake;

use Illuminate\Database\Eloquent\Model;

/** @mixin Model */
trait HasSnowflake
{
    public static function bootHasSnowflake(): void
    {
        static::creating(static function (Model $model) {
            if (is_null($model->getKey())) {
                $model->setAttribute($model->getKeyName(), Snowflake::id());
            }
        });
    }

    public function initializeHasSnowflake(): void
    {
        $this->casts[$this->getKeyName()] = 'string';
        $this->incrementing = false;
    }
}
