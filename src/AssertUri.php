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

    /**
     * Asserts the url scheme
     *
     * @param string $scheme
     * @param string $message
     *
     * @return self
     */
    public function scheme($scheme, $message = '')
    {
        Assert::assertSame($scheme, $this->uri->getScheme(), $message);

        return $this;
    }

    /**
     * Asserts the url authority
     *
     * @param string $autority
     * @param string $message
     *
     * @return self
     */
    public function authority($authority, $message = '')
    {
        Assert::assertSame($authority, $this->uri->getAuthority(), $message);

        return $this;
    }

    /**
     * Asserts the url user info
     *
     * @param string $userInfo
     * @param string $message
     *
     * @return self
     */
    public function userInfo($userInfo, $message = '')
    {
        Assert::assertSame($userInfo, $this->uri->getUserInfo(), $message);

        return $this;
    }

    /**
     * Asserts the url host
     *
     * @param string $host
     * @param string $message
     *
     * @return self
     */
    public function host($host, $message = '')
    {
        Assert::assertSame($host, $this->uri->getHost(), $message);

        return $this;
    }

    /**
     * Asserts the url port
     *
     * @param int    $port
     * @param string $message
     *
     * @return self
     */
    public function port($port, $message = '')
    {
        Assert::assertSame($port, $this->uri->getPort(), $message);

        return $this;
    }

    /**
     * Asserts the url path
     *
     * @param int    $path
     * @param string $message
     *
     * @return self
     */
    public function path($path, $message = '')
    {
        Assert::assertSame($path, $this->uri->getPath(), $message);

        return $this;
    }

    /**
     * Asserts the url query
     *
     * @param string $query
     * @param string $message
     *
     * @return self
     */
    public function query($query, $message = '')
    {
        Assert::assertSame($query, $this->uri->getQuery(), $message);

        return $this;
    }

    /**
     * Asserts the url fragment
     *
     * @param string $fragment
     * @param string $message
     *
     * @return self
     */
    public function fragment($fragment, $message = '')
    {
        Assert::assertSame($fragment, $this->uri->getFragment(), $message);

        return $this;
    }

    /**
     * Asserts the whole url
     *
     * @param string $url
     * @param string $message
     *
     * @return self
     */
    public function string($url, $message = '')
    {
        Assert::assertSame($url, (string) $this->uri, $message);

        return $this;
    }
}
