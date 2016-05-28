<?php

use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response;
use Zend\Diactoros\Uri;
use Zend\Diactoros\UploadedFile;
use Zend\Diactoros\Stream;
use Psr7Unitesting\Assert;

class AppTest extends PHPUnit_Framework_TestCase
{
    public function testServerRequest()
    {
        $request = (new ServerRequest(['DOCUMENT_ROOT' => '/www']))
            ->withMethod('GET')
            ->withUri(new Uri('http://user:pass@dag.gal/?ola#id'))
            ->withQueryParams(['ola' => 'value'])
            ->withAttribute('bar', 'foo')
            ->withCookieParams(['cookie-name' => 'cookie-value'])
            ->withParsedBody(['name' => 'value'])
            ->withUploadedFiles([
                'file' => new UploadedFile('file.jpg', 50, 0, 'file.jpg', 'image/jpg'),
            ])
            ->withBody(new Stream('php://temp', 'r'))
            ->withHeader('Content-Type', 'text/html');

        Assert::create($request)
            ->protocolVersion('1.1')
            ->header('Content-Type', 'text/html')
            ->hasHeader('Content-Type')
            ->hasNotHeader('X-Content-Type')
            ->requestTarget('/?ola')
            ->uri('http://user:pass@dag.gal/?ola#id')
            ->method('GET')
            ->attribute('bar', 'foo')
            ->hasAttribute('bar')
            ->hasParsedBody('name')
            ->parsedBody('name', 'value')
            ->hasUploadedFile('file')
            ->hasQueryParam('ola')
            ->queryParam('ola', 'value')
            ->cookieParam('cookie-name', 'cookie-value')
            ->hasCookieParam('cookie-name')
            ->hasServerParam('DOCUMENT_ROOT')
            ->serverParam('DOCUMENT_ROOT', '/www')
            ->assertUri()
                ->scheme('http')
                ->authority('user:pass@dag.gal')
                ->host('dag.gal')
                ->query('ola')
                ->fragment('id')
                ->path('/')
                ->userInfo('user:pass')
                ->port(null)
                ->end()

            ->assertBody()
                ->isNotWritable()
                ->isReadable()
                ->isSeekable()
                ->size(0);
    }

    public function testResponse()
    {
        $response = (new Response())
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200, 'Ok!');

        $response->getBody()->write(<<<HTML
<!DOCTYPE html>
<html>
    <head>
        <title>Hello world</title>
    </head>
    <body>
        <h1>Ola mundo</h1>
        <div class="first">Ola mundo</div>
        <div class="second">Ola mundo</div>
    </body>
</html>
HTML
);

    Assert::create($response)
        ->protocolVersion('1.1')
        ->header('Content-Type', 'text/html')
        ->hasHeader('Content-Type')
        ->hasNotHeader('X-Content-Type')
        ->statusCode(200)
        ->reasonPhrase('Ok!')
        ->assertBody()
            ->isWritable()
            ->isReadable()
            ->isSeekable()
            ->size(225)
            ->assertHtml()
                ->count('div', 2)
                ->has('h1')
                ->hasNot('section')
                ->contains('h1', 'mundo')
                ->notContains('h1', 'mundor');
    }
}
