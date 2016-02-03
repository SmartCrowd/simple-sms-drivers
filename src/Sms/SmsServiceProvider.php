<?php
namespace SmartCrowd\Sms;

class SmsServiceProvider extends \SimpleSoftwareIO\SMS\SMSServiceProvider
{

    public function registerSender()
    {
        $this->app['sms.sender'] = $this->app->share(function ($app) {
            return (new DriverManager($app))->driver();
        });
    }
}
