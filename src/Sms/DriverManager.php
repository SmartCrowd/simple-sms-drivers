<?php

namespace SmartCrowd\Sms;

use SmartCrowd\Sms\Drivers\SmsRu;
use SmartCrowd\Sms\Drivers\SmsCenter;
use SmartCrowd\Sms\Drivers\SmsClub;
use GuzzleHttp\Client;
use SimpleSoftwareIO\SMS\DriverManager as BaseDriverManager;

class DriverManager extends BaseDriverManager
{
    /**
     * Create an instance of the smsru driver
     *
     * @return SmsRu
     */
    public function createSmsruDriver(){
        $config = $this->app['config']->get('sms.smsru', []);

        $driver = new SmsRu(new Client);
        $driver->buildBody([
            'api_id' => $config['api_id']
        ]);

        return $driver;
    }

    /**
     * Create an instance of the smscenter driver
     *
     * @return SmsCenter
     */
    public function createSmscenterDriver(){
        $config = $this->app['config']->get('sms.smscenter', []);

        $driver = new SmsCenter(new Client);
        $driver->buildBody([
            'login' => $config['login'],
            'psw'   => $config['password'],
        ]);

        return $driver;
    }

    /**
     * Create an instance of the smsclub driver
     *
     * @return SmsClub
     */
    public function createSmsclubDriver(){
        $config = $this->app['config']->get('sms.smsclub', []);

        $driver = new SmsClub(new Client);
        $driver->buildBody([
            'username'   => $config['login'],
            'password'   => $config['password'],
            'lifetime'   => 60 * 24 * 30, // one month
        ]);

        return $driver;
    }

}