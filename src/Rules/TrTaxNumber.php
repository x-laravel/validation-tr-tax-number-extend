<?php

namespace XLaravel\ValidationTrTaxNumberExtend\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use XAdam\TrTaxNumberValidation;

class TrTaxNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!self::passes($value)) {
            $fail('tr-tax-number::validation.tr_tax_number')->translate();
        }
    }

    public static function passes(mixed $value): bool
    {
        return (is_int($value) || is_string($value)) && TrTaxNumberValidation::validate($value);
    }
}
