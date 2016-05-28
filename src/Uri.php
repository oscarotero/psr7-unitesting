<?php

namespace Psr7Unitesting;

use Psr\Http\Message\UriInterface;

/**
 * Class to execute assertions with a UriInterface instance.
 */
class Uri extends Utils\AbstractAssert
{
    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * Constructor.
     *
     * @param UriInterface        $uri
     * @param AbstractAssert|null $previous
     */
    public function __construct(UriInterface $uri, Utils\AbstractAssert $previous = null)
    {
        $this->uri = $uri;
        $this->previous($previous);
    }

    /**
     * Asserts the url scheme.
     *
     * @param string $scheme
     * @param string $message
     *
     * @return self
     */
    public function scheme($scheme, $message = '')
    {
        return $this->assert($this->uri, new Uri\Scheme($scheme), $message);
    }

    /**
     * Asserts the url authority.
     *
     * @param string $authority
     * @param string $message
     *
     * @return self
     */
    public function authority($authority, $message = '')
    {
        return $this->assert($this->uri, new Uri\Authority($authority), $message);
    }

    /**
     * Asserts the url user info.
     *
     * @param string $userInfo
     * @param string $message
     *
     * @return self
     */
    public function userInfo($userInfo, $message = '')
    {
        return $this->assert($this->uri, new Uri\UserInfo($userInfo), $message);
    }

    /**
     * Asserts the url host.
     *
     * @param string $host
     * @param string $message
     *
     * @return self
     */
    public function host($host, $message = '')
    {
        return $this->assert($this->uri, new Uri\Host($host), $message);
    }

    /**
     * Asserts the url port.
     *
     * @param int    $port
     * @param string $message
     *
     * @return self
     */
    public function port($port, $message = '')
    {
        return $this->assert($this->uri, new Uri\Port($port), $message);
    }

    /**
     * Asserts the url path.
     *
     * @param int    $path
     * @param string $message
     *
     * @return self
     */
    public function path($path, $message = '')
    {
        return $this->assert($this->uri, new Uri\Path($path), $message);
    }

    /**
     * Asserts the url query.
     *
     * @param string $query
     * @param string $message
     *
     * @return self
     */
    public function query($query, $message = '')
    {
        return $this->assert($this->uri, new Uri\Query($query), $message);
    }

    /**
     * Asserts the url fragment.
     *
     * @param string $fragment
     * @param string $message
     *
     * @return self
     */
    public function fragment($fragment, $message = '')
    {
        return $this->assert($this->uri, new Uri\Fragment($fragment), $message);
    }
}
