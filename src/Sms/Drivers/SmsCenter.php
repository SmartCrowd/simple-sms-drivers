<?php namespace SmartCrowd\Sms\Drivers;

use GuzzleHttp\Client;
use SimpleSoftwareIO\SMS\Drivers\AbstractSMS;
use SimpleSoftwareIO\SMS\Drivers\DriverInterface;
use SimpleSoftwareIO\SMS\IncomingMessage;
use SimpleSoftwareIO\SMS\OutgoingMessage;

class SmsCenter extends AbstractSMS implements DriverInterface
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
        throw new \RuntimeException('Sms Center does not support Inbound API Calls.');
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
            'phones' => implode(',', $message->getTo()),
            'mes'    => $composedMessage,
            'sender' => $message->getFrom()
        ];

        $this->buildCall('/send.php');
        $this->buildBody($data);

        $raw = (string) $this->getRequest()->getBody();

        $result = json_decode($raw);
        if (!empty($result['id'])) {
            return $result['id'];
        } else {
            return false;
        }
    }

    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     * @return array
     */
    public function checkMessages(Array $options = array())
    {
        throw new \RuntimeException('Sms Center does not support Inbound API Calls.');
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param $messageId
     * @return IncomingMessage
     */
    public function getMessage($messageId)
    {
        throw new \RuntimeException('Sms Center does not support Inbound API Calls.');
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return \SimpleSoftwareIO\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        throw new \RuntimeException('Sms Center does not support Inbound API Calls.');
    }
}