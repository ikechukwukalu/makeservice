# CLAMAV FILE UPLOAD

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ikechukwukalu/clamavfileupload?style=flat-square)](https://packagist.org/packages/ikechukwukalu/clamavfileupload)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/ikechukwukalu/clamavfileupload/main?style=flat-square)](https://scrutinizer-ci.com/g/ikechukwukalu/clamavfileupload/)
[![Github Workflow Status](https://img.shields.io/github/actions/workflow/status/ikechukwukalu/clamavfileupload/clamavfileupload.yml?branch=main&style=flat-square)](https://github.com/ikechukwukalu/clamavfileupload/actions/workflows/clamavfileupload.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ikechukwukalu/clamavfileupload?style=flat-square)](https://packagist.org/packages/ikechukwukalu/clamavfileupload)
[![Licence](https://img.shields.io/packagist/l/ikechukwukalu/clamavfileupload?style=flat-square)](https://packagist.org/packages/ikechukwukalu/clamavfileupload)

A laravel package for scaffolding service classes.

## REQUIREMENTS

- PHP 5+
- Laravel 5+

## STEPS TO INSTALL

``` shell
composer require ikechukwukalu/clamavfileupload
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
