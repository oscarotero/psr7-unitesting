<?php

namespace Psr7Unitesting;

use GuzzleHttp\Client;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

abstract class Assert
{

    public static function get($uri)
    {
        $client = new Client();

        return self::create($client->get($uri));
    }

    public static function create($object)
    {
        if ($object instanceof ServerRequestInterface) {
            return new ServerRequest($object);
        }

        if ($object instanceof RequestInterface) {
            return new Request($object);
        }

        if ($object instanceof ResponseInterface) {
            return new Response($object);
        }

        if ($object instanceof UriInterface) {
            return new Uri($object);
        }

        if ($object instanceof StreamInterface) {
            return new Stream($object);
        }
    }
}