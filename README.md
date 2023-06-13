# MAKE SERVICE

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/ikechukwukalu/makeservice/main?style=flat-square)](https://scrutinizer-ci.com/g/ikechukwukalu/makeservice/)
[![Code Quality](https://img.shields.io/codefactor/grade/github/ikechukwukalu/makeservice?style=flat-square)](https://www.codefactor.io/repository/github/ikechukwukalu/makeservice)
[![Vulnerability](https://img.shields.io/snyk/vulnerabilities/github/ikechukwukalu/makeservice?style=flat-square)](https://security.snyk.io/package/composer/ikechukwukalu%2Fclamavfileupload)
[![Github Workflow Status](https://img.shields.io/github/actions/workflow/status/ikechukwukalu/makeservice/makeservice.yml?branch=main&style=flat-square)](https://github.com/ikechukwukalu/makeservice/actions/workflows/makeservice.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Licence](https://img.shields.io/packagist/l/ikechukwukalu/makeservice?style=flat-square)](https://github.com/ikechukwukalu/makeservice/blob/main/LICENSE.md)

A laravel package for scaffolding Service, Traits, Repository and Interface classes.

## REQUIREMENTS

- PHP 8.0+
- Laravel 9+

## STEPS TO INSTALL

``` shell
composer require ikechukwukalu/makeservice
```

## SERVICE CLASS

To generate a new service class.

``` shell
php artisan make:service SampleService
php artisan make:service SampleService --force //This will overwrite an existing service class.
```

To generate a new service class for a particular request class.

``` shell
php artisan make:request SampleRequest
php artisan make:service SampleService --request=SampleRequest
```

## TRAIT CLASS

To generate a new trait class.

``` shell
php artisan make:trait SampleTrait
php artisan make:trait SampleTrait --force //This will overwrite an existing trait class.
```

## ENUM CLASS

To generate a new trait class.

``` shell
php artisan make:enum Sample
php artisan make:enum Sample --force //This will overwrite an existing enum class.
```

## INTERFACE CLASS

To generate a new interface class.

``` shell
php artisan make:interface SampleInterface
php artisan make:interface SampleInterface --force //This will overwrite an existing interface class.
```

## REPOSITORY CLASS

To generate a new repository class for a particular interface class.

``` shell
php artisan make:interface UserRepositoryInterface --model=User
php artisan make:repository UserRepository --model=User --interface=UserRepositoryInterface
php artisan make:repository UserRepository --model=User --interface=UserRepositoryInterface --force //This will overwrite an existing repository class.
```

### Bind the interface and the implementation

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

## LICENSE

The MS package is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
