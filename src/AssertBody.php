<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\StreamInterface;

class AssertBody
{
	protected $body;

	public function __construct(StreamInterface $body)
	{
		$this->body = $body;
	}

	public function size($size, $message = '')
	{
		Assert::assertSame($size, $this->body->getSize(), $message);
		
		return $this;
	}

	public function isSeekable($message = '')
	{
		Assert::assertTrue($this->body->isSeekable(), $message);
		
		return $this;
	}

	public function isWritable($message = '')
	{
		Assert::assertTrue($this->body->isWritable(), $message);
		
		return $this;
	}

	public function isReadable($message = '')
	{
		Assert::assertTrue($this->body->isReadable(), $message);
		
		return $this;
	}
}
