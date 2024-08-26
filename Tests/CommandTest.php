<?php

namespace Ikechukwukalu\Makeservice\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_fires_make_service_command(): void
    {
        $this->artisan('make:service SampleService')->assertSuccessful();

        $this->artisan('make:service SampleService -f')->assertSuccessful();

        $this->artisan('make:request SampleRequest')->assertSuccessful();

        $this->artisan('make:service SampleService --request=SampleRequest -f')->assertSuccessful();

        $this->artisan('make:service SampleService --request=SampleRequest -e')->assertSuccessful();

        $this->artisan('make:service SampleService --request=SampleRequest -e -f')->assertSuccessful();

        $this->artisan('make:traitclass SampleTrait')->assertSuccessful();

        $this->artisan('make:traitclass SampleTrait -f')->assertSuccessful();

        $this->artisan('make:enumclass Sample')->assertSuccessful();

        $this->artisan('make:enumclass Sample -f')->assertSuccessful();

        $this->artisan('make:action Sample')->assertSuccessful();

        $this->artisan('make:action Sample -f')->assertSuccessful();

        $this->artisan('make:interfaceclass SampleInterface')->assertSuccessful();

        $this->artisan('make:interfaceclass SampleInterface -f')->assertSuccessful();

        $this->artisan('make:interfaceclass UserRepositoryInterface --model=User')->assertSuccessful();

        $this->artisan('make:interfaceclass UserRepositoryInterface --model=User -f')->assertSuccessful();

        $this->artisan('make:repository UserRepository --interface=UserRepositoryInterface --model=User')->assertSuccessful();

        $this->artisan('make:repository UserRepository --interface=UserRepositoryInterface --model=User -f')->assertSuccessful();

        $this->artisan('make:repository UserRepository --model=User -c')->assertSuccessful();

        $this->artisan('make:repository UserRepository --model=User -c -f')->assertSuccessful();

        $this->artisan('make:facade Sample')->assertSuccessful();

        $this->artisan('make:facade Sample -f')->assertSuccessful();

        $this->artisan('make:facade User --contract=UserRepositoryInterface')->assertSuccessful();

        $this->artisan('make:facade User --contract=UserRepositoryInterface -f')->assertSuccessful();
    }
}
