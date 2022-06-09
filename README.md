# ❄️ Generate IDs using Twitter Snowflake

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dive-be/laravel-snowflake.svg?style=flat-square)](https://packagist.org/packages/dive-be/laravel-snowflake)


This package assists you in creating [Snowflake identifiers](https://en.wikipedia.org/wiki/Snowflake_ID) for your Eloquent models.

It is a Laravel wrapper for [godruoyi/php-snowflake](https://github.com/godruoyi/php-snowflake).

## What problem does this package solve?

Please refer to the [original library](https://github.com/godruoyi/php-snowflake) for more information regarding Snowflakes.

## Installation

You can install the package via composer:

```bash
composer require dive-be/laravel-snowflake
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Dive\Snowflake\ServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /**
     * Set this value to today when starting a new app.
     * You will have 69 years before you run out of snowflakes.
     */
    'start_date' => '2022-04-10',
];
```

## Usage

> ⚠️ Use a high-performing cache driver such as `Redis` to ensure rapid ID generation. 

> ❗️ Do **not** use an ephemeral cache driver such as `array` in production!

### Migrations

- Use `snowflake` to define a Snowflake column
- Use `foreignSnowflake` to reference another Snowflake (alias for `foreignId`)

```php
Schema::table('products', static function (Blueprint $table) {
    $table->snowflake();
    $table->foreignSnowflake('variant_id')->constrained();
});
```

### Models

Use the `HasSnowflake` trait in your Eloquent models:

```php
class Product extends Model
{
    use HasSnowflake;
}
```

### Manual generation

You have a couple of options if you'd like to generate your Snowflake identifiers manually:

```php
Snowflake::id(); // Facade
snowflake(); // Helper
app('snowflake'); // Service Locator

// Dependency Injection
public function __construct(\Godruoyi\Snowflake\Snowflake $snowflake) {}
```

### 📣 Note on JavaScript compatibility

While JavaScript itself actually [supports `BigInt`s](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/BigInt), 
the `JSON` standard does not.

```js
JSON.parse("{\"a\":10n}")
// Uncaught SyntaxError: Unexpected token n in JSON at position 7
```

Therefore, to make sure the identifiers are not truncated while deserializing them on the front-end using `JSON.parse` and alike, 
the package will automatically cast the models' `id` field to `string`.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email oss@dive.be instead of using the issue tracker.

## Credits

- [Muhammed Sari](https://github.com/mabdullahsari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
