<?php

namespace Psr7Unitesting\Assert;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\ResponseInterface;

/**
 * Class to execute assertions with a ResponseInterface instance.
 */
class Response extends Message
{
    /**
     * @var ResponseInterface
     */
    protected $message;

    /**
     * Constructor.
     *
     * @param ResponseInterface $message
     * @param BaseAssert|null   $previous
     */
    public function __construct(ResponseInterface $message, BaseAssert $previous = null)
    {
        parent::__construct($message, $previous);
    }

    /**
     * Asserts the status code of the response.
     *
     * @param int    $code
     * @param string $message
     *
     * @return self
     */
    public function statusCode($code, $message = '')
    {
        Assert::assertSame($code, $this->message->getStatusCode(), $message);

        return $this;
    }

    /**
     * Asserts the reason phrase.
     *
     * @param string $reasonPhrase
     * @param string $message
     *
     * @return self
     */
    public function reasonPhrase($reasonPhrase, $message = '')
    {
        Assert::assertSame($reasonPhrase, $this->message->getReasonPhrase(), $message);

        return $this;
    }

    /**
     * Creates an instance of Html to execute assertions with the html code.
     *
     * @return Html
     */
    public function assertHtml()
    {
        return new Html($this->message->getBody(), $this);
    }
}
