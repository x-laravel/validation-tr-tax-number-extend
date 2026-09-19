# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-09-20

### Changed

- Minimum PHP version raised from 7.0 to 8.2; supported Laravel versions are now 12 and 13.
- Requires `x-adam/tr-tax-number-validation` 5, which rejects input containing non-digit characters.
- The rule class is renamed from `Rules\TrTaxNumberRule` to `Rules\TrTaxNumber` and implements
  `Illuminate\Contracts\Validation\ValidationRule` instead of the deprecated `Rule`.
- The service provider is renamed from `Providers\ValidationTrTaxNumberExtendServiceProvider` to
  `TrTaxNumberServiceProvider` at the package root.
- Translations move from `resources/lang` to `lang`, use the `tr-tax-number` namespace and the
  `validation.tr_tax_number` key.

### Fixed

- Non-scalar input (arrays, booleans, floats) now fails validation instead of throwing a `TypeError`.

### Added

- English translation alongside the Turkish one.
- Language files are publishable with `php artisan vendor:publish --tag=tr-tax-number-translations`.
- Orchestra Testbench test suite and a GitHub Actions matrix across PHP 8.2–8.5 and Laravel 12–13,
  plus PHPStan (Larastan) at level max.
- MIT license file.

[2.0.0]: https://github.com/X-Laravel/validation-tr-tax-number-extend/compare/v1.0.0...v2.0.0
