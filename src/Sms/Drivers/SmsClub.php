<?php

namespace SmartCrowd\Sms\Drivers;

use GuzzleHttp\Client;
use SimpleSoftwareIO\SMS\Drivers\AbstractSMS;
use SimpleSoftwareIO\SMS\Drivers\DriverInterface;
use SimpleSoftwareIO\SMS\IncomingMessage;
use SimpleSoftwareIO\SMS\OutgoingMessage;

class SmsClub extends AbstractSMS implements DriverInterface
{
    /**
     * The Guzzle HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The API's URL.
     *
     * @var string
     */
    protected $apiBase = 'https://gate.smsclub.mobi/http';

    /**
     * The ending of the URL that all requests must have.
     *
     * @var array
     */
    protected $apiEnding = ['fmt' => '3'];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Creates many IncomingMessage objects and sets all of the properties.
     *
     * @param $rawMessage
     * @return mixed
     */
    protected function processReceive($rawMessage)
    {
        throw new \RuntimeException('Sms Club does not support Inbound API Calls.');
    }

    /**
     * Sends a SMS message
     *
     * @param OutgoingMessage $message
     * @return false|int
     * @throws \Exception
     */
    public function send(OutgoingMessage $message)
    {
        $composedMessage = $message->composeMessage();

        $data = [
            'to'   => implode(';', $message->getTo()),
            'text' => base64_encode( iconv("UTF-8", "windows-1251", $composedMessage) ),
            'from' => $message->getFrom()
        ];

        $this->buildCall('/httpsendsms.php');
        $this->buildBody($data);

        $raw = (string) $this->getRequest()->getBody();

        if (strpos($raw, '=IDS START=') !== false) {
            $ids = array_filter(explode('<br/>', $raw), function ($val) {
                return preg_match('/^\d*$/', $val);
            });

            return $ids;
        }

        return false;
    }

    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     * @return array
     */
    public function checkMessages(Array $options = array())
    {
        throw new \RuntimeException('Sms Club does not support Inbound API Calls.');
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param $messageId
     * @return IncomingMessage
     */
    public function getMessage($messageId)
    {
        throw new \RuntimeException('Sms Club does not support Inbound API Calls.');
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return \SimpleSoftwareIO\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        throw new \RuntimeException('Sms Club does not support Inbound API Calls.');
    }
}
