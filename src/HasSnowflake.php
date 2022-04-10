<?php declare(strict_types=1);

namespace Dive\Snowflake;

use Illuminate\Database\Eloquent\Model;

trait HasSnowflake
{
    public static function bootHasSnowflake()
    {
        static::creating(static function (Model $model) {
           if (is_null($model->getKey())) {
               $model->setAttribute($model->getKeyName(), Snowflake::id());
           }
        });
    }

    public function initializeHasSnowflake()
    {
        $this->incrementing = false;
    }
}
