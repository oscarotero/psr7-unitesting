<?php

namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;
use Closure;

/**
 * Class to execute html related assertions in a StreamInterface instance.
 */
class Html extends Stream
{
    /**
     * @var Crawler
     */
    protected $html;

    /**
     * Constructor.
     *
     * @param StreamInterface     $stream
     * @param AbstractAssert|null $previous
     */
    public function __construct(StreamInterface $stream, Utils\AbstractAssert $previous = null)
    {
        parent::__construct($stream, $previous);

        $this->html = new Crawler();
        $this->html->addContent($this->string);
    }

    /**
     * Asserts the number of elements matching with a selector.
     *
     * @param string $selector
     * @param int    $count
     * @param string $message
     *
     * @return self
     */
    public function count($selector, $count, $message = '')
    {
        return $this->assert($this->html, new Html\Count($selector, $count), $message);
    }

    /**
     * Asserts that there is (at least) one element matching with a selector.
     *
     * @param string $selector
     * @param string $message
     *
     * @return self
     */
    public function has($selector, $message = '')
    {
        return $this->assert($this->html, new Html\Has($selector), $message);
    }

    /**
     * Asserts that there is not elements matching with a selector.
     *
     * @param string $selector
     * @param string $message
     *
     * @return self
     */
    public function hasNot($selector, $message = '')
    {
        return $this->assert($this->html, new Html\HasNot($selector), $message);
    }

    /**
     * Asserts that there is (at least) one element matching with a selector and content.
     *
     * @param string $selector
     * @param string $text
     * @param string $message
     *
     * @return self
     */
    public function contains($selector, $text, $message = '')
    {
        return $this->assert($this->html, new Html\Contains($selector, $text), $message);
    }

    /**
     * Asserts that there is no elements matching with a selector and content.
     *
     * @param string $selector
     * @param string $text
     * @param string $message
     *
     * @return self
     */
    public function notContains($selector, $text, $message = '')
    {
        return $this->assert($this->html, new Html\NotContains($selector, $text), $message);
    }

    /**
     * Asserts that the html is valid.
     *
     * @param string $message
     *
     * @return self
     */
    public function isValid($message = '')
    {
        return $this->assert($this->string, new Html\IsValid(), $message);
    }

    /**
     * Executes the callback for each element found.
     *
     * @param string  $selector
     * @param Closure $callback
     *
     * @return self
     */
    public function map($selector, Closure $callback)
    {
        $this->html->filter($selector)->each($callback);

        return $this;
    }
}
