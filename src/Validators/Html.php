<?php
namespace Psr7Unitesting\Validators;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Process\Process;
use Psr\Http\Message\StreamInterface;

/**
 * Class to validate the html code using the w3c API
 */
class Html
{
    const METHOD_REST = 1;
    const METHOD_CLI = 2;

    protected $html;
    protected $result;
    protected $method;

    /**
     * Constructor
     *
     * @param string $html
     * @param int    $method
     */
    public function __construct($html, $method = 2)
    {
        $this->html = $html;
        $this->method = $method;
    }

    /**
     * Execute the validation through the command line
     */
    protected function validateCLI()
    {
        $vnu = __DIR__.'/../../bins/vnu/vnu.jar';

        $process = new Process("java -jar {$vnu} --format json - ", null, null, $this->html);

        $process->run();

        $output = $process->getOutput() ?: $process->getErrorOutput();

        $this->result = json_decode((string) $output, true);
    }

    /**
     * Execute the validation through the api
     */
    protected function validateREST()
    {
        $request = new Request('POST', 'https://validator.w3.org/nu/?out=json', ['Content-Type' => 'text/html; charset=utf-8'], $this->body);
        $client = new Client();

        $response = $client->send($request);

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
            switch ($this->method) {
                case static::METHOD_CLI:
                    $this->validateCLI();
                    break;

                case static::METHOD_REST:
                    $this->validateREST();
                    break;
                
                default:
                    throw new RuntimeException('Invalid validation method');
            }
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
