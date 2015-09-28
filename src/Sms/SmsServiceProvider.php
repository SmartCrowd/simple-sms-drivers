<?php namespace SmartCrowd\Sms;

use GuzzleHttp\Client;
use SmartCrowd\Sms\Drivers\SmsCenter;

class SmsServiceProvider extends \SimpleSoftwareIO\SMS\SMSServiceProvider
{

    public function registerSender()
    {
        try {

            return parent::registerSender();

        } catch (\InvalidArgumentException $e) {

            $driver = config('sms.driver');

            switch ($driver) {
                case 'smsru':
                    return $this->buildSmsRu();

                case 'smscenter':
                    return $this->buildSmsCenter();

                default:
                    throw new \InvalidArgumentException('Invalid SMS driver.', 0, $e);
            }
        }
    }

    protected function buildSmsCenter()
    {
        $provider = new SmsCenter(new Client);

        $provider->buildBody([
            'login' => config('sms.smscenter.login'),
            'psw'   => config('sms.smscenter.password'),
        ]);

        return $provider;
    }

    protected function buildSmsRu()
    {
        $provider = new SmsCenter(new Client);

        $provider->buildBody([
            'api_id' => config('sms.smsru.api_id'),
        ]);

        return $provider;
    }
}