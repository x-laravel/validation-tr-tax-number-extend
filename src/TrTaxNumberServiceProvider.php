<?php

namespace XLaravel\ValidationTrTaxNumberExtend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use XLaravel\ValidationTrTaxNumberExtend\Rules\TrTaxNumber;

class TrTaxNumberServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'tr-tax-number');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/tr-tax-number'),
        ], 'tr-tax-number-translations');

        Validator::extend('tr_tax_number', fn (string $attribute, mixed $value) => TrTaxNumber::passes($value));
    }
}
