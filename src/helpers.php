<?php declare(strict_types=1);

if (! function_exists('snowflake')) {
    function snowflake(): string
    {
        return app(__FUNCTION__)->id();
    }
}
