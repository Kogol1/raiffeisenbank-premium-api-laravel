# Simple Raiffeisenbank premium API layer for Laravel (Bank accounts, Transactions)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kogol1/raiffeisenbank-premium-api-laravel.svg?style=flat-square)](https://packagist.org/packages/kogol1/raiffeisenbank-premium-api-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kogol1/raiffeisenbank-premium-api-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kogol1/raiffeisenbank-premium-api-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kogol1/raiffeisenbank-premium-api-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kogol1/raiffeisenbank-premium-api-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kogol1/raiffeisenbank-premium-api-laravel.svg?style=flat-square)](https://packagist.org/packages/kogol1/raiffeisenbank-premium-api-laravel)

Laravel API layer for Raiffeisenbank premium API. This package is a simple wrapper for Raiffeisenbank API. It allows you to get bank accounts and transactions as DTOs.

Just with:

```php
(new BankAccount("1234567890"))->getTransactions();
```
## Installation

You can install the package via composer:

```bash
composer require kogol1/raiffeisenbank-premium-api-laravel
```

### Generate Cert files from .p12
TODO: How to generate .pem files from .p12

Put your .p12 file somewhere in your project and set the path in your .env file

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="raiffeisenbank-premium-api-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="raiffeisenbank-premium-api-laravel-config"
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
