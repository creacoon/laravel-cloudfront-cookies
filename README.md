# A tiny utility to generate signed cookies to be used with AWS Cloudfront

[![Latest Version on Packagist](https://img.shields.io/packagist/v/creacoon/laravel-cloudfront-cookies.svg?style=flat-square)](https://packagist.org/packages/creacoon/laravel-cloudfront-cookies)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/creacoon/laravel-cloudfront-cookies/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/creacoon/laravel-cloudfront-cookies/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/creacoon/laravel-cloudfront-cookies/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/creacoon/laravel-cloudfront-cookies/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/creacoon/laravel-cloudfront-cookies.svg?style=flat-square)](https://packagist.org/packages/creacoon/laravel-cloudfront-cookies)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require creacoon/laravel-cloudfront-cookies
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-cloudfront-cookies-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-cloudfront-cookies-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-cloudfront-cookies-views"
```

## Usage

Add the middleware to set the cookies needed for AWS CloudFront

## Testing

Generate a private key
```bash
openssl genrsa -out private.key.pem
```

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

- [Charaf Rezrazi](https://github.com/Rezrazi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
