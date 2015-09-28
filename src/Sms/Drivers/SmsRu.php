<?php namespace SmartCrowd\Sms\Drivers;

use GuzzleHttp\Client;
use SimpleSoftwareIO\SMS\Drivers\AbstractSMS;
use SimpleSoftwareIO\SMS\Drivers\DriverInterface;
use SimpleSoftwareIO\SMS\IncomingMessage;
use SimpleSoftwareIO\SMS\OutgoingMessage;

class SmsRu extends AbstractSMS implements DriverInterface
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
    protected $apiBase = 'https://smsc.ru/sys';

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
        // TODO: Implement processReceive() method.
    }

    /**
     * Sends a SMS message
     *
     * @parma SimpleSoftwareIO\SMS\Message @messasge The message class.
     * @return void
     */
    public function send(OutgoingMessage $message)
    {
        // TODO: Implement send() method.
    }

    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     * @return array
     */
    public function checkMessages(Array $options = array())
    {
        // TODO: Implement checkMessages() method.
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param $messageId
     * @return IncomingMessage
     */
    public function getMessage($messageId)
    {
        // TODO: Implement getMessage() method.
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return \SimpleSoftwareIO\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        // TODO: Implement receive() method.
    }
}