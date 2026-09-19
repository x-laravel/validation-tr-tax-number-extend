# Turkish Tax Number Validation for Laravel

<p align="center">
<a href="https://github.com/X-Laravel/validation-tr-tax-number-extend/actions/workflows/tests.yml"><img src="https://github.com/X-Laravel/validation-tr-tax-number-extend/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-tax-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/v/x-laravel/validation-tr-tax-number-extend" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-tax-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/php-v/x-laravel/validation-tr-tax-number-extend" alt="PHP Version"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-tax-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/dt/x-laravel/validation-tr-tax-number-extend" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/x-laravel/validation-tr-tax-number-extend" rel="nofollow"><img src="https://img.shields.io/packagist/l/x-laravel/validation-tr-tax-number-extend" alt="License"></a>
</p>

A Laravel validation rule for Turkish tax identification numbers (Vergi Kimlik No). It wraps
[x-adam/tr-tax-number-validation](https://github.com/X-Adam/tr-tax-number-validation), which checks
the number offline against the official checksum rule — no network access, no dependencies beyond
Laravel itself.

## Requirements

| Package version | PHP | Laravel |
|-----------------|-----|---------|
| 2.x | 8.2+ | 12, 13 |
| 1.x | 7.0+ | 5.5+ |

## Installation

```bash
composer require x-laravel/validation-tr-tax-number-extend
```

The service provider is registered through package discovery.

## Usage

### Rule object

```php
use XLaravel\ValidationTrTaxNumberExtend\Rules\TrTaxNumber;

$request->validate([
    'tax_no' => ['required', new TrTaxNumber],
]);
```

The rule object comes with Turkish and English error messages and picks the one matching the
application locale.

### String alias

```php
$request->validate([
    'tax_no' => ['required', 'tr_tax_number'],
]);
```

For the string alias Laravel resolves the error message the way it does for any extended rule, so
add a line to your application's `lang/xx/validation.php`:

```php
'tr_tax_number' => ':attribute geçerli bir vergi kimlik numarası olmalıdır.',
```

Without it Laravel falls back to the raw key `validation.tr_tax_number`. You can also pass an inline
message through the validator's `messages` argument or a form request's `messages()` method.

Either form accepts `int` and `string` values; anything else — arrays, booleans, floats — fails
validation instead of throwing.

## Customising the messages

To change the rule object's messages, publish the language files and edit them:

```bash
php artisan vendor:publish --tag=tr-tax-number-translations
```

They land in `lang/vendor/tr-tax-number/{tr,en}/validation.php`.

## What it checks

The rule answers **"is this a well-formed tax number?"** — length and the check digit. It does not
verify that the number is registered to a particular taxpayer; that requires querying the Revenue
Administration (GİB).

## Testing

```bash
composer install
composer test
```

The suite runs on Orchestra Testbench against every supported Laravel and PHP combination in CI.

## License

Open source software licensed under the [MIT license](LICENSE).
