# MAKE SERVICE

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/ikechukwukalu/makeservice/main?style=flat-square)](https://scrutinizer-ci.com/g/ikechukwukalu/makeservice/)
[![Github Workflow Status](https://img.shields.io/github/actions/workflow/status/ikechukwukalu/makeservice/makeservice.yml?branch=main&style=flat-square)](https://github.com/ikechukwukalu/makeservice/actions/workflows/makeservice.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)
[![Licence](https://img.shields.io/packagist/l/ikechukwukalu/makeservice?style=flat-square)](https://packagist.org/packages/ikechukwukalu/makeservice)

A laravel package for scaffolding service classes.

## REQUIREMENTS

- PHP 7.1+
- Laravel 5.7+

## STEPS TO INSTALL

``` shell
composer require ikechukwukalu/makeservice
```

## SERVICE CLASS

To generate a new service class.

- `php artisan make:service SampleService`
- `php artisan make:service SampleService --force`. This will overwrite and existing service class.

To generate a new service class for a particular request class.

- `php artisan make:request SampleRequest`
- `php artisan make:service SampleService --request=SampleRequest`

## LICENSE

The MS package is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
