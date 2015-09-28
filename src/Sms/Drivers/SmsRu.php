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
    protected $apiBase = 'http://sms.ru/sms';


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
        throw new \RuntimeException('Sms Ru does not support Inbound API Calls.');
    }

    /**
     * Sends a SMS message
     *
     * @parma OutgoingMessage $message The message class.
     * @param OutgoingMessage $message
     * @return false|string
     */
    public function send(OutgoingMessage $message)
    {
        $composedMessage = $message->composeMessage();

        $data = [
            'to'     => implode(',', $message->getTo()),
            'text'   => $composedMessage,
            'from'   => $message->getFrom(),
        ];

        $this->buildCall('/send');
        $this->buildBody($data);

        $raw = (string) $this->getRequest()->getBody();

        $result = explode("\n", $raw);
        if ($result[0] == '100') {
            return $result[1];
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
        throw new \RuntimeException('Sms Ru does not support Inbound API Calls.');
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param $messageId
     * @return IncomingMessage
     */
    public function getMessage($messageId)
    {
        throw new \RuntimeException('Sms Ru does not support Inbound API Calls.');
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return \SimpleSoftwareIO\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        throw new \RuntimeException('Sms Ru does not support Inbound API Calls.');
    }
}