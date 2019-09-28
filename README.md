# A Laravel wrapper for the zumba/amplitude-php package.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/francescomalatesta/laravel-amplitude.svg?style=flat-square)](https://packagist.org/packages/francescomalatesta/laravel-amplitude)
[![Build Status](https://img.shields.io/travis/francescomalatesta/laravel-amplitude/master.svg?style=flat-square)](https://travis-ci.org/francescomalatesta/laravel-amplitude)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/francescomalatesta/laravel-amplitude/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/francescomalatesta/laravel-amplitude/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/francescomalatesta/laravel-amplitude.svg?style=flat-square)](https://packagist.org/packages/francescomalatesta/laravel-amplitude)

This package will be your best friend if you need to track events for your Laravel application in Amplitude.

This package is compatible with the 5.8 version of Laravel.

## Installation

You can install the package via composer:

```bash
composer require francescomalatesta/laravel-amplitude
```

Do not forget to publish the config file with Artisan:

```bash
artisan vendor:publish
```

To be up and running, just add the Amplitude API Key of your project in the `.env` file, using `AMPLITUDE_API_KEY` as key.

If you want to use the `Amplitude` facade, remember to add the following line to your `config/app.php`, in the `aliases` item.

```php
'aliases' => [
    ...

    'Amplitude' => LaravelAmplitude\Facades\Amplitude::class
]
```

## Usage

Laravel Amplitude uses a simple syntax to track your product events easily.

### Setting the User Id

First of all, before sending anything, you will need to set the User ID.

```php
Amplitude::setUserId('user_id');
```

Note: setting the user id is MANDATORY. Otherwise, you will get an error when trying to send data to Amplitude.

### 

Once the user id is set, you are ready to send events to your Amplitude project.

```php
// simple sending...
Amplitude::sendEvent('app_opened');

// sending with properties...
Amplitude::sendEvent('subscription_paid', ['was_trial' => true]);
```

Also, you can change the user properties with the dedicated method `setUserProperties`:

```php
// properties new values are set here
Amplitude::setUserProperties([
    'trial' => false,
    'plan' => 'professional'
]);

// data is sent to Amplitude here
Amplitude::sendEvent('subscription_paid', ['was_trial' => true]);
```

IMPORTANT: the properties will be sent to Amplitude at the next `sendEvent` call. Without any other call to `sendEvent`, the new user properties are not going to be saved.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email francesco@ahia.store instead of using the issue tracker.

## Credits

- [Francesco Malatesta](https://github.com/francescomalatesta)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
