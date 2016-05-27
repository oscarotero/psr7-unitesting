<?php

namespace Psr7Unitesting\Utils;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class Exporter
{
    /**
     * @param string $value
     */
    public function export($value)
    {
        if ($value instanceof ServerRequestInterface) {
            return 'ServerRequest instance';
        }

        if ($value instanceof RequestInterface) {
            return 'Request instance';
        }

        if ($value instanceof ResponseInterface) {
            return 'Response instance';
        }

        if ($value instanceof StreamInterface) {
            return 'Stream instance';
        }

        if ($value instanceof UriInterface) {
            return 'Uri instance';
        }

        if ($value instanceof Crawler) {
            return 'Html content';
        }

        if (is_object($value)) {
            return get_class($value);
        }

        return gettype($value);
    }
}
