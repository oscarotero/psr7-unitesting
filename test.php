<?php
include 'vendor/autoload.php';

use GuzzleHttp\Client;
use Psr7Unitesting\Assert;

class AppTest extends PHPUnit_Framework_TestCase
{
    public function testOne()
    {
        $client = new Client();

        $response = $client->get('http://dag.gal');

        (new Assert\Response($response))
            ->statusCode(200)
            ->hasHeader('Content-Type')
            ->hasNotHeader('Accept')
            ->hasHeaderWithText('Content-Type', 'text/html; charset=utf-8')
            ->protocolVersion('1.1')
            ->getHtmlBody()
                ->isValid()
                ;
    }
}
