<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\DomCrawler\Crawler;

class AssertHtmlBody extends AssertBody
{
	protected $html;

	public function __construct(StreamInterface $body)
	{
		parent::__construct($body);

		$this->html = new Crawler();
		$this->html->addContent((string) $body);
	}

	public function hasElement($selector, $message = '')
	{
		Assert::assertGreaterThan(0, count($this->html->filter($selector)), $message);

		return $this;
	}

	public function countElements($selector, $count, $message = '')
	{
		Assert::assertCount($count, $this->html->filter($selector), $message);

		return $this;
	}

	public function hasElementWithText($selector, $text, $message = '')
	{
		$texts = $this->html->filter($selector)->each(function ($node, $i) {
			return trim($node->text());
		});

		Assert::assertContains(trim($text), $texts, $message);

		return $this;
	}
}
