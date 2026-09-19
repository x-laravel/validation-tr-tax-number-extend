<?php

namespace XLaravel\ValidationTrTaxNumberExtend\Tests;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use XLaravel\ValidationTrTaxNumberExtend\Rules\TrTaxNumber;

class TrTaxNumberTest extends TestCase
{
    #[DataProvider('validValues')]
    public function testRuleObjectAcceptsValidNumbers(int|string $value): void
    {
        $validator = Validator::make(['tax_no' => $value], ['tax_no' => new TrTaxNumber]);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidValues')]
    public function testRuleObjectRejectsInvalidValues(mixed $value): void
    {
        $validator = Validator::make(['tax_no' => $value], ['tax_no' => new TrTaxNumber]);

        $this->assertTrue($validator->fails());
    }

    public function testRuleObjectMessageIsTranslatedInEnglish(): void
    {
        $validator = Validator::make(['tax_no' => '3973535711'], ['tax_no' => new TrTaxNumber]);

        $this->assertSame(
            'The tax no field must be a valid Turkish tax number.',
            $validator->errors()->first('tax_no'),
        );
    }

    public function testRuleObjectMessageIsTranslatedInTurkish(): void
    {
        App::setLocale('tr');

        $validator = Validator::make(['tax_no' => '3973535711'], ['tax_no' => new TrTaxNumber]);

        $this->assertSame(
            'tax no geçerli bir vergi kimlik numarası olmalıdır.',
            $validator->errors()->first('tax_no'),
        );
    }

    #[DataProvider('validValues')]
    public function testStringAliasAcceptsValidNumbers(int|string $value): void
    {
        $validator = Validator::make(['tax_no' => $value], ['tax_no' => 'tr_tax_number']);

        $this->assertTrue($validator->passes());
    }

    #[DataProvider('invalidValues')]
    public function testStringAliasRejectsInvalidValues(mixed $value): void
    {
        $validator = Validator::make(['tax_no' => $value], ['tax_no' => 'tr_tax_number']);

        $this->assertTrue($validator->fails());
    }

    public function testStringAliasUsesInlineMessage(): void
    {
        $validator = Validator::make(
            ['tax_no' => '3973535711'],
            ['tax_no' => 'tr_tax_number'],
            ['tax_no.tr_tax_number' => 'Custom message for :attribute'],
        );

        $this->assertSame('Custom message for tax no', $validator->errors()->first('tax_no'));
    }

    public function testStringAliasFallsBackToTranslationKeyWithoutAppMessage(): void
    {
        $validator = Validator::make(['tax_no' => '3973535711'], ['tax_no' => 'tr_tax_number']);

        $this->assertSame('validation.tr_tax_number', $validator->errors()->first('tax_no'));
    }

    public function testStringAliasSkipsNullableEmptyValues(): void
    {
        $validator = Validator::make(['tax_no' => null], ['tax_no' => ['nullable', 'tr_tax_number']]);

        $this->assertTrue($validator->passes());
    }

    /** @return array<string, array{int|string}> */
    public static function validValues(): array
    {
        return [
            'string' => ['3973535717'],
            'integer' => [3973535717],
            'leading zero' => ['0000000001'],
        ];
    }

    /** @return array<string, array{mixed}> */
    public static function invalidValues(): array
    {
        return [
            'wrong checksum' => ['3973535711'],
            'too short' => ['397353571'],
            'letters' => ['abcdefghij'],
            'letters with valid checksum digit' => ['abcdefghi1'],
            'array' => [['3973535717']],
            'boolean' => [true],
            'float' => [3973535717.0],
        ];
    }
}
