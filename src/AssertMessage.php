<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\MessageInterface;

class AssertMessage
{
	protected $message;

	public function __construct(MessageInterface $message)
	{
		$this->message = $message;
	}

	public function hasHeader($name, $message = '')
	{
		Assert::assertTrue($this->message->hasHeader($name), $message);
		
		return $this;
	}

	public function hasNotHeader($name, $message = '')
	{
		Assert::assertFalse($this->message->hasHeader($name), $message);
		
		return $this;
	}

	public function header($name, $value, $message = '')
	{
		Assert::assertSame($value, $this->message->getHeaderLine($name), $message);
		
		return $this;
	}

	public function protocolVersion($version, $message = '')
	{
		Assert::assertSame($version, $this->message->getProtocolVersion(), $message);
		
		return $this;
	}

	public function getBody()
	{
		return new AssertBody($this->message->getBody());
	}
}