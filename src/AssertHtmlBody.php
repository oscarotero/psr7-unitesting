<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class to execute html related assertions in a StreamInterface instance
 */
class AssertHtmlBody extends AssertBody
{
    protected $html;

    /**
     * Constructor
     *
     * @param StreamInterface $body
     */
    public function __construct(StreamInterface $body)
    {
        parent::__construct($body);

        $this->html = new Crawler();
        $this->html->addContent($this->string);
    }

    /**
     * Asserts the number of elements matching with a selector
     *
     * @param string  $selector
     * @param integer $count
     * @param string  $message
     *
     * @return self
     */
    public function countElements($selector, $count, $message = '')
    {
        Assert::assertCount($count, $this->html->filter($selector), $message);

        return $this;
    }

    /**
     * Asserts that there is (at least) one element matching with a selector
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
     * Asserts that there is not elements matching with a selector
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
     * Asserts that there is (at least) one element matching with a selector and content
     *
     * @param string $selector
     * @param string $text
     * @param string $message
     *
     * @return self
     */
    public function hasElementWithText($selector, $text, $message = '')
    {
        $texts = $this->html->filter($selector)->each(function ($node, $i) {
            return trim($node->text());
        });

        Assert::assertContains(trim($text), $texts, $message);

        return $this;
    }

    /**
     * Asserts that there is no elements matching with a selector and content
     *
     * @param string $selector
     * @param string $text
     * @param string $message
     *
     * @return self
     */
    public function hasNotElementWithText($selector, $text, $message = '')
    {
        $texts = $this->html->filter($selector)->each(function ($node, $i) {
            return trim($node->text());
        });

        Assert::assertNotContains(trim($text), $texts, $message);

        return $this;
    }

    /**
     * Executes the callback for each element found
     *
     * @param string   $selector
     * @param callable $callback
     *
     * @return self
     */
    public function foreachElement($selector, callable $callback)
    {
        $this->html->filter($selector)->each($callback);

        return $this;
    }
}
