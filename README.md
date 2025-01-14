# Simple Raiffeisenbank premium API layer for Laravel (Bank accounts, Transactions)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/38778603-kogol1/raiffeisenbank-premium-api-laravel.svg?style=flat-square)](https://packagist.org/packages/38778603-kogol1/raiffeisenbank-premium-api-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/38778603-kogol1/raiffeisenbank-premium-api-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/38778603-kogol1/raiffeisenbank-premium-api-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/38778603-kogol1/raiffeisenbank-premium-api-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/38778603-kogol1/raiffeisenbank-premium-api-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/38778603-kogol1/raiffeisenbank-premium-api-laravel.svg?style=flat-square)](https://packagist.org/packages/38778603-kogol1/raiffeisenbank-premium-api-laravel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Generate Cert files from .p12



## Installation

You can install the package via composer:

```bash
composer require 38778603-kogol1/raiffeisenbank-premium-api-laravel
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="raiffeisenbank-premium-api-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="raiffeisenbank-premium-api-laravel-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="raiffeisenbank-premium-api-laravel-views"
```

## Usage

```php
$raiffeisenbankPremiumApiLaravel = new Kogol1\RaiffeisenbankPremiumApiLaravel();
echo $raiffeisenbankPremiumApiLaravel->echoPhrase('Hello, Kogol1!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Matyas Moudry](https://github.com/38778603+Kogol1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
