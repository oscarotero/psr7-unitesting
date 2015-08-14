<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\ResponseInterface;

/**
 * Class to execute assertions with a ResponseInterface instance
 */
class AssertResponse extends AssertMessage
{
    /**
     * Constructor
     *
     * @param ResponseInterface $message
     */
    public function __construct(ResponseInterface $message)
    {
        parent::__construct($message);
    }

    /**
     * Asserts the status code of the response
     *
     * @param integer $code
     * @param string  $message
     *
     * @return self
     */
    public function statusCode($code, $message = '')
    {
        Assert::assertSame($code, $this->message->getStatusCode(), $message);

        return $this;
    }

    /**
     * Asserts the reason phrase
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
     * Creates an instance of AssertHtmlBody to execute assertions with the html code
     *
     * @return AssertHtmlBody
     */
    public function getHtmlBody()
    {
        return new AssertHtmlBody($this->message->getBody());
    }
}
