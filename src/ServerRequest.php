<?php

namespace Psr7Unitesting;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class to execute assertions in a ServerRequestInstance message.
 */
class ServerRequest extends Request
{
    /**
     * @var ServerRequestInterface
     */
    protected $message;

    /**
     * Constructor.
     *
     * @param ServerRequestInterface $message
     * @param AbstractAssert|null    $previous
     */
    public function __construct(ServerRequestInterface $message, Utils\AbstractAssert $previous = null)
    {
        parent::__construct($message, $previous);
    }

    /**
     * Check if the server params contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasServerParam($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasServerParam($key), $message);
    }

    /**
     * Asserts a server param.
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function serverParam($key, $value, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\ServerParam($key, $value), $message);
    }

    /**
     * Check if the cookie params contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasCookieParam($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasCookieParam($key), $message);
    }

    /**
     * Asserts a cookie param.
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function cookieParam($key, $value, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\CookieParam($key, $value), $message);
    }

    /**
     * Check if the query params contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasQueryParam($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasQueryParam($key), $message);
    }

    /**
     * Asserts a query param.
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function queryParam($key, $value, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\QueryParam($key, $value), $message);
    }

    /**
     * Check if the uploadedFiles contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasUploadedFile($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasUploadedFile($key), $message);
    }

    /**
     * Check if the parsedBody params contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasParsedBody($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasParsedBody($key), $message);
    }

    /**
     * Asserts a parsedBody param.
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function parsedBody($key, $value, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\ParsedBody($key, $value), $message);
    }

    /**
     * Check if the attributes contains a key.
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function hasAttribute($key, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\HasAttribute($key), $message);
    }

    /**
     * Asserts an attribute.
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function attribute($key, $value, $message = '')
    {
        return $this->assert($this->message, new ServerRequest\Attribute($key, $value), $message);
    }
}
