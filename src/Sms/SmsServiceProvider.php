<?php namespace SmartCrowd\Sms;

use GuzzleHttp\Client;
use SmartCrowd\Sms\Drivers\SmsCenter;
use SmartCrowd\Sms\Drivers\SmsRu;

class SmsServiceProvider extends \SimpleSoftwareIO\SMS\SMSServiceProvider
{

    public function registerSender()
    {
        parent::registerSender();

        $sender = $this->app['sms.sender'];

        $sender->extend('smsru', function ($app) {

            $config = $app['config']->get('sms.smsru', []);

            $driver = new SmsRu(new Client);
            $driver->buildBody([
                'api_id' => $config['api_id']
            ]);

            return $driver;
        });

        $sender->extend('smscenter', function ($app) {

            $config = $app['config']->get('sms.smscenter', []);

            $driver = new SmsCenter(new Client);
            $driver->buildBody([
                'login' => $config['login'],
                'psw'   => $config['password'],
            ]);

            return $driver;
        });

        $sender->extend('smsclub', function ($app) {

            $config = $app['config']->get('sms.smsclub', []);

            $driver = new SmsClub(new Client);
            $driver->buildBody([
                'username'   => $config['login'],
                'password'   => $config['password'],
                'lifetime'   => 60 * 24 * 30, // one month
            ]);

            return $driver;
        });
    }
}
