<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class to execute assertions in a ServerRequestInstance message
 */
class AssertServerRequest extends AssertRequest
{
    /**
     * Constructor
     *
     * @param ServerRequestInterface $message
     */
    public function __construct(ServerRequestInterface $message)
    {
        parent::__construct($message);
    }

    /**
     * Check if the server params contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function serverHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getServerParams(), $message);

        return $this;
    }

    /**
     * Asserts a server param
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function server($key, $value, $message = '')
    {
        $this->serverHasKey($key, $message);
        Assert::assertSame($value, $this->message->getServerParams()[$key], $message);

        return $this;
    }

    /**
     * Check if the cookie params contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function cookieHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getCookieParams(), $message);

        return $this;
    }

    /**
     * Asserts a cookie param
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function cookie($key, $value, $message = '')
    {
        $this->cookieHasKey($key, $message);
        Assert::assertSame($value, $this->message->getCookieParams()[$key], $message);

        return $this;
    }

    /**
     * Check if the query params contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function queryHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getQueryParams(), $message);

        return $this;
    }

    /**
     * Asserts a query param
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function query($key, $value, $message = '')
    {
        $this->queryHasKey($key, $message);
        Assert::assertSame($value, $this->message->getQueryParams()[$key], $message);

        return $this;
    }

    /**
     * Check if the uploadedFiles contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function uploadedFilesHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getUploadedFiles(), $message);

        return $this;
    }

    /**
     * Asserts a uploaded file subset
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function uploadedFile($key, array $subset, $message = '')
    {
        $this->uploadedFilesHasKey($key, $message);
        Assert::assertSame($subset, $this->message->getUploadedFiles()[$key], $message);

        return $this;
    }

    /**
     * Check if the parsedBody params contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function parsedBodyHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getParsedBody(), $message);

        return $this;
    }

    /**
     * Asserts a parsedBody param
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function parsedBody($key, $value, $message = '')
    {
        $this->parsedBodyHasKey($key, $message);
        Assert::assertSame($value, $this->message->getParsedBody()[$key], $message);

        return $this;
    }

    /**
     * Check if the attributes contains a key
     *
     * @param string $key
     * @param string $message
     *
     * @return self
     */
    public function attributesHasKey($key, $message = '')
    {
        Assert::assertArrayHasKey($key, $this->message->getAttributes(), $message);

        return $this;
    }

    /**
     * Asserts an attribute
     *
     * @param string $key
     * @param string $value
     * @param string $message
     *
     * @return self
     */
    public function attribute($key, $value, $message = '')
    {
        $this->attributesHasKey($key, $message);
        Assert::assertSame($value, $this->message->getAttributes()[$key], $message);

        return $this;
    }
}
