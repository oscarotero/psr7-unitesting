<?php

namespace Psr7Unitesting\Assert;

use Psr7Unitesting\Validators\Html as HtmlValidator;
use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;
use Closure;

/**
 * Class to execute html related assertions in a StreamInterface instance.
 */
class Html extends Body
{
    /**
     * @var Crawler
     */
    protected $html;

    /**
     * Constructor.
     *
     * @param StreamInterface $body
     * @param BaseAssert|null $previous
     */
    public function __construct(StreamInterface $body, BaseAssert $previous = null)
    {
        parent::__construct($body, $previous);

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
    public function countElements($selector, $count, $message = '')
    {
        Assert::assertCount($count, $this->html->filter($selector), $message);

        return $this;
    }

    /**
     * Asserts that there is (at least) one element matching with a selector.
     *
     * @param string $selector
     * @param string $message
     *
     * @return self
     */
    public function hasElement($selector, $message = '')
    {
        Assert::assertGreaterThan(0, count($this->html->filter($selector)), $message);

        return $this;
    }

    /**
     * Asserts that there is not elements matching with a selector.
     *
     * @param string $selector
     * @param string $message
     *
     * @return self
     */
    public function hasNotElement($selector, $message = '')
    {
        return $this->countElements($selector, 0, $message);
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
    public function hasElementWithText($selector, $text, $message = '')
    {
        $texts = $this->html->filter($selector)->each(function ($node) {
            return trim($node->text());
        });

        Assert::assertContains(trim($text), $texts, $message);

        return $this;
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
    public function hasNotElementWithText($selector, $text, $message = '')
    {
        $texts = $this->html->filter($selector)->each(function ($node) {
            return trim($node->text());
        });

        Assert::assertNotContains(trim($text), $texts, $message);

        return $this;
    }

    /**
     * Asserts that the html is valid.
     *
     * @param int    $method  One of the HtmlValidator::METHOD_* constants
     * @param string $message
     *
     * @return self
     */
    public function isValid($method = HtmlValidator::METHOD_CLI, $message = '')
    {
        $validator = new HtmlValidator($this->body, $method);
        $errors = array_values($validator->getErrors());

        Assert::assertEmpty($errors, (empty($message) ? '' : "{$message}\n").print_r($errors, true));

        return $this;
    }

    /**
     * Executes the callback for each element found.
     *
     * @param string  $selector
     * @param Closure $callback
     *
     * @return self
     */
    public function foreachElement($selector, Closure $callback)
    {
        $this->html->filter($selector)->each($callback);

        return $this;
    }
}
