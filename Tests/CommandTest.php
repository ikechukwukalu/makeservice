<?php

namespace Ikechukwukalu\Makeservice\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_fires_make_service_command(): void
    {
        $this->artisan('make:service SampleService')->assertSuccessful();

        $this->artisan('make:service SampleService --force')->assertSuccessful();

        $this->artisan('make:request SampleRequest')->assertSuccessful();

        $this->artisan('make:service SampleService --request=SampleRequest --force')->assertSuccessful();
    }
}
