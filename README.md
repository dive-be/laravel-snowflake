# Generate IDs using Twitter Snowflake

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dive-be/laravel-snowflake.svg?style=flat-square)](https://packagist.org/packages/dive-be/laravel-snowflake)


This package assists you in creating [Snowflake identifiers](https://en.wikipedia.org/wiki/Snowflake_ID) for your Eloquent models.

It is a Laravel wrapper for [godruoyi/php-snowflake](https://github.com/godruoyi/php-snowflake).

## What problem does this package solve?

Please refer to the [original library](https://github.com/godruoyi/php-snowflake) for more information regarding Snowflakes.

We have intentionally ignored the settings for a distributed architectural setup.
You would not be using this package anyway if you were to hit such an enormous scale.


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

> ⚠️ We recommend to use a high-performing cache driver such as `Redis` to ensure rapid ID generation. 

> ❗️ Do **not** use an ephemeral cache driver such as `array` in production!

TODO

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
