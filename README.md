# KPAPostMail - Email Launcher for Laravel

[![Latest Stable Version](https://poser.pugx.org/king052188/kpapostmail/v/stable)](https://packagist.org/packages/king052188/kpapostmail)
[![Total Downloads](https://poser.pugx.org/king052188/kpapostmail/downloads)](https://packagist.org/packages/king052188/kpapostmail)
[![Latest Unstable Version](https://poser.pugx.org/king052188/kpapostmail/v/unstable)](https://packagist.org/packages/king052188/kpapostmail)
[![License](https://poser.pugx.org/king052188/kpapostmail/license)](https://packagist.org/packages/king052188/kpapostmail)


KPAPostMail is a package for **Laravel 5+** that provides helpers for some common Mail Sending techniques.

## Installation
### 1 - Dependency
The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:
```shell
composer require king052188/kpapostmail
```
> **Note**: If you are using Laravel 5.5, the steps 2 and 3, for providers and aliases, are unnecessaries. KPAPostMail supports Laravel new [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery).

### 2 - Provider
You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
// file START ommited
    'providers' => [
        // other providers ommited
        king052188\KPAPostMail\KPAPostMailServiceProvider::class,
    ],
// file END ommited
```

### 3 - Facade

> Facades are not supported in Lumen.

In order to use the `KPAPostMail` facade, you need to register it on the `config/app.php` file, you can do that the following way:

```php
// file START ommited
    'aliases' => [
        'KPAPostMail' => king052188\KPAPostMail\Facades\KPAPostMail::class,
    ],
// file END ommited
```

### 4 Configuration

#### Publish config

In your terminal type
```shell
php artisan vendor:publish
```
or
```shell
php artisan vendor:publish --provider="king052188\KPAPostMail\KPAPostMailServiceProvider"
```

### 5 Set up your API

In order to use the `KPAPostMail`, get your Access Token from here [Sign-Up](https://postmail.kpa.ph).

> `config/services.php`

```php
// file START ommited
    'KPAPostMail' => [
        'domain' => env('KPAPostMail_DOMAIN', 'postmail.kpa21.info'),
        'email' => env('KPAPostMail_EMAIL', 'YOUR-EMAIL-ADDRESS'),
        'uid' => env('KPAPostMail_UID', 'YOUR-UID'),
    ],
// file END ommited
```