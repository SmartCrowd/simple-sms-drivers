# simple-sms-drivers
Addition drivers for simple SMS laravel package

## Installition
```bash 
composer require "smart-crowd/simple-sms-drivers: dev-master"
```

Instead of original simple sms service provider, set our:
```php
'providers' => [
  ...
  SmartCrowd\Sms\SmsServiceProvider::class
]
```

Set original simple sms alias:
```php
'aliases' => [
  ...
  'SMS' => SimpleSoftwareIO\SMS\Facades\SMS::class
```

Publish original simple sms config:
```bash 
php artisan vendor:publish
```

Now you can set up addtition sms drivers in `config/sms.php` file:
```php
'smscenter' => [
    'login' => env('SMS_CENTER_LOGIN'),
    'password' => env('SMS_CENTER_PASSWORD')
],
'smsru' => [
    'api_id' => env('SMS_RU_API_ID')
],
```

## Usage
See [original documentation](https://github.com/SimpleSoftwareIO/simple-sms/blob/master/README.md#usage)
