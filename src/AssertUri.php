<?php
namespace Psr7Unitesting;

use Psr\Http\Message\UriInterface;

/**
 * Class to execute assertions with a UriInterface instance
 */
class AssertUri
{
    protected $uri;

    /**
     * Constructor
     *
     * @param UriInterface $uri
     */
    public function __construct(UriInterface $uri)
    {
        $this->uri = $uri;
    }
}
