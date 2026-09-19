<?php

namespace XLaravel\ValidationTrTaxNumberExtend\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use XLaravel\ValidationTrTaxNumberExtend\TrTaxNumberServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [TrTaxNumberServiceProvider::class];
    }
}
