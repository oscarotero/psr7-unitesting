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
        $vnu = __DIR__.'/../../vendor/vnu/validator/vnu.jar';

        if (!is_file($vnu)) {
            $vnu = __DIR__.'/../../../../vendor/vnu/validator/vnu.jar';
        }

        if (!is_file($vnu)) {
            throw new \RuntimeException("vnu.jar file not found!");
        }

        $process = new Process("java -jar {$vnu} --format json - ", null, null, (string) $this->body);

        $process->run();

        $output = $process->getOutput() ?: $process->getErrorOutput();

        $this->result = json_decode((string) $output, true);
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
