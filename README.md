# hocuspocus-laravel

> Integrates hocuspocus into Laravel with a few clicks

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/hocuspocus_laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus-laravel-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Ueberdosis\HocuspocusLaravel\HocuspocusLaravelServiceProvider" --tag="hocuspocus-laravel-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Credits

- [Kris Siepert](https://github.com/kriskbx)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
