<?php declare(strict_types=1);

namespace Illuminate\Database\Schema
{
    class Blueprint
    {
        public function foreignSnowflake(): ForeignIdColumnDefinition {}

        public function snowflake(): ColumnDefinition {}
    }
}
