<?php

namespace Psr7Unitesting\Html;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class IsValid extends Constraint
{
    const METHOD_REST = 1;
    const METHOD_CLI = 2;
    const BIN_FILE = '/vnu.16.3.3/vnu.jar';

    public static $method = 2;
    private $errors = [];

    public function toString()
    {
        return 'is valid HTML';
    }

    protected function matches($html)
    {
        if (self::$method === static::METHOD_CLI) {
            $result = $this->validateCLI($html);
        } elseif (self::$method === static::METHOD_REST) {
            $result = $this->validateREST($html);
        } else {
            throw new RuntimeException('Invalid validation method');
        }

        $this->errors = array_filter($result['messages'], function ($message) {
            return $message['type'] === 'error';
        });

        return empty($this->errors);
    }

    /**
     * Execute the validation through the command line.
     */
    private static function validateCLI($html)
    {
        $vnu = __DIR__.'/../../bins/'.self::BIN_FILE;

        $process = new Process("java -jar {$vnu} --format json - ", null, null, $html);

        $process->run();

        $output = $process->getOutput() ?: $process->getErrorOutput();

        return json_decode((string) $output, true);
    }

    /**
     * Execute the validation through the api.
     */
    private static function validateREST($html)
    {
        $request = new Request('POST', 'https://validator.w3.org/nu/?out=json', ['Content-Type' => 'text/html; charset=utf-8'], $html);
        $client = new Client();

        $response = $client->send($request);

        return json_decode((string) $response->getBody(), true);
    }

    protected function additionalFailureDescription($html)
    {
        return sprintf('%d errors found: %s', count($this->errors), print_r(array_values($this->errors), true));
    }
}
