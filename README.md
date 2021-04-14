# Integrates hocuspocus into Laravel with a few clicks

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/hocuspocus_laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus_laravel-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus_laravel-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$hocuspocus_laravel = new Ueberdosis\HocuspocusLaravel();
echo $hocuspocus_laravel->echoPhrase('Hello, Spatie!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kris Siepert](https://github.com/kriskbx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
