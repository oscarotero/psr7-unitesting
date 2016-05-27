<?php

namespace Psr7Unitesting;

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
     * @param ResponseInterface   $message
     * @param AbstractAssert|null $previous
     */
    public function __construct(ResponseInterface $message, Utils\AbstractAssert $previous = null)
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
        return $this->assert($this->message, new Response\StatusCode($code), $message);
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
        return $this->assert($this->message, new Response\ReasonPhrase($reasonPhrase), $message);
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
