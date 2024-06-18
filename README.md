# MAKE SERVICE

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/ikechukwukalu/makeservice/main?style=flat-square)](https://scrutinizer-ci.com/g/ikechukwukalu/makeservice/)
[![Code Quality](https://img.shields.io/codefactor/grade/github/ikechukwukalu/makeservice?style=flat-square)](https://www.codefactor.io/repository/github/ikechukwukalu/makeservice)
[![Known Vulnerabilities](https://snyk.io/test/github/ikechukwukalu/makeservice/badge.svg?style=flat-square)](https://security.snyk.io/package/composer/ikechukwukalu%2Fmakeservice)
[![Github Workflow Status](https://img.shields.io/github/actions/workflow/status/ikechukwukalu/makeservice/makeservice.yml?branch=main&style=flat-square)](https://github.com/ikechukwukalu/makeservice/actions/workflows/makeservice.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Licence](https://img.shields.io/packagist/l/ikechukwukalu/makeservice?style=flat-square)](https://github.com/ikechukwukalu/makeservice/blob/main/LICENSE.md)

A laravel package for scaffolding Service, Traits, Enums, Facades, Actions, Repository and Interface classes.

## REQUIREMENTS

- PHP 7.3+
- Laravel 8+

## STEPS TO INSTALL

``` shell
composer require ikechukwukalu/makeservice
```

## SERVICE CLASS

To generate a new service class.

``` shell
php artisan make:service SampleService

php artisan make:service SampleService  -f //This will overwrite an existing service class.
```

To generate a new service class for a particular request class.

``` shell
php artisan make:request SampleRequest

php artisan make:service SampleService --request=SampleRequest
```

To generate a service class and a form request class together

```shell
php artisan make:service SampleService --request=SampleRequest -e
```

## TRAIT CLASS

To generate a new trait class.

``` shell
php artisan make:traitclass SampleTrait

php artisan make:traitclass SampleTrait  -f //This will overwrite an existing trait class.
```

## ENUM CLASS

To generate a new enum class.

``` shell
php artisan make:enumclass Sample

php artisan make:enumclass Sample  -f //This will overwrite an existing enum class.
```

## ACTION CLASS

To generate a new action class.

``` shell
php artisan make:action Sample

php artisan make:action Sample  -f //This will overwrite an existing action class.
```

## CONTRACT CLASS

To generate a new contract/interface  class.

``` shell
php artisan make:interface SampleInterface

php artisan make:interface SampleInterface  -f //This will overwrite an existing interface  class.
```

## REPOSITORY CLASS

To generate a new repository class for a particular contract/interface  class.

``` shell
php artisan make:interface UserRepositoryInterface --model=User

php artisan make:repository UserRepository --model=User --interface=UserRepositoryInterface

php artisan make:repository UserRepository --model=User --interface=UserRepositoryInterface  -f //This will overwrite an existing repository class.
```

To generate a repository class and a contract/interface  class together

```shell
php artisan make:repository UserRepository --model=User -c
```

## FACADE CLASS

To generate a new facade class.

``` shell
php artisan make:facade Sample

php artisan make:facade Sample  -f //This will overwrite an existing facade class.
```

To generate a facade class for a repository class

```shell
php artisan make:facade User --contract=UserRepositoryInterface
```

### Bind the contract and the repository class

The last thing we need to do is bind `UserRepository` to `UserRepositoryInterface` in Laravel's Service Container. We will do this via a Service Provider. Create one using the following command:

``` shell
php artisan make:provider RepositoryServiceProvider
```

Open `app/Providers/RepositoryServiceProvider.php` and update the register function to match the following:

``` php
public function register()
{
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
}
```

Finally, add the new Service Provider to the providers array in `config/app.php`.

``` php
'providers' => [
    // ...other declared providers
    App\Providers\RepositoryServiceProvider::class,
];
```

### Bind the facade and the action class

If we have a `User` facade class and a `UserService` action class, we would need to add it to Laravel's Service Container. Facades for respository classes will work without any extra binding since they have already been added to the container within the `RepositoryServiceProvider` class, but we would always need to register every facade class we created.

Create the provider:

``` shell
php artisan make:provider FacadeServiceProvider
```

Bind the action class:

``` php
public function register()
{
    $this->app->bind('user', UserService::class);
}
```

Register the providers:

``` php
'providers' => [
    // ...other declared providers
    App\Providers\FacadeServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
];
```

Finally, add the facade to the aliases array in `config/app.php`.

``` php
    'aliases' => Facade::defaultAliases()->merge([
    // ...other declared facades
        'User' => App\Facades\User::class,
    ])->toArray(),
```

## LICENSE

The MS package is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
