<?php

namespace Ikechukwukalu\Makeservice\Tests;

use Ikechukwukalu\Makeservice\MakeServiceServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
      parent::setUp();
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [MakeServiceServiceProvider::class];
    }
}
