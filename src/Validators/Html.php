<?php
namespace Psr7Unitesting\Validators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\StreamInterface;

/**
 * Class to validate the html code using the w3c API
 */
class Html
{
    protected $body;
    protected $client;
    protected $result;

    /**
     * Constructor
     *
     * @param StreamInterface $body
     */
    public function __construct(StreamInterface $body, Client $client = null)
    {
        $this->body = $body;
        $this->client = $client;
    }

    /**
     * Execute the validation
     */
    protected function validate()
    {
        $request = new Request('POST', 'https://validator.w3.org/nu/?out=json', ['Content-Type' => 'text/html; charset=utf-8'], $this->body);

        if ($this->client === null) {
            $this->client = new Client();
        }

        $response = $this->client->send($request);

        $this->result = json_decode((string) $response->getBody(), true);
    }

    /**
     * Returns the validator results
     *
     * @return array
     */
    public function getResult()
    {
        if ($this->result === null) {
            $this->validate();
        }

        return $this->result;
    }

    /**
     * Returns the validator errors
     *
     * @return array
     */
    public function getErrors()
    {
        $result = $this->getResult();

        return array_filter($result['messages'], function ($message) {
            return $message['type'] === 'error';
        });
    }
}
