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
    protected static $callable;

    protected $body;
    protected $result;
    protected $useCli = true;

    /**
     * Constructor
     *
     * @param StreamInterface $body
     */
    public function __construct(StreamInterface $body)
    {
        $this->body = $body;
    }

    /**
     * Set false to use http api instead cli
     * 
     * @param bool $cli
     * 
     * @return self
     */
    public function useCli($cli = true)
    {
        $this->useCli = $cli;

        return $this;
    }

    /**
     * Detect and return the java callable
     * 
     * @return string|false
     */
    protected static function getCallable()
    {
        if (isset(static::$callable)) {
            return static::$callable;
        }

        $vnu = __DIR__.'/../../vendor/vnu/validator/vnu.jar';

        if (!is_file($vnu)) {
            $vnu = __DIR__.'/../../../../vendor/vnu/validator/vnu.jar';
        }

        return static::$callable = (is_file($vnu) ? $vnu : false);
    }

    /**
     * Execute the validation through the command line
     */
    protected function validateCli()
    {
        $vnu = static::getCallable();

        if (empty($vnu)) {
            throw new \RuntimeException("vnu.jar file not found!");
        }

        $process = new Process("java -jar {$vnu} --format json - ", null, null, (string) $this->body);

        $process->run();

        $output = $process->getOutput() ?: $process->getErrorOutput();

        $this->result = json_decode((string) $output, true);
    }

    /**
     * Execute the validation through the api
     */
    protected function validateAPI()
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
            if ($this->useCli) {
                $this->validateCli();
            } else {
                $this->validateAPI();
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
