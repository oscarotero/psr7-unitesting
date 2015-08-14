<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\RequestInterface;

class AssertRequest extends AssertMessage
{
	public function method($method, $message = '')
	{
		Assert::assertSame($method, $this->message->getMethod(), $message);
		
		return $this;
	}

	public function requestTarget($requestTarget, $message = '')
	{
		Assert::assertSame($requestTarget, $this->message->getRequestTarget(), $message);
		
		return $this;
	}

	public function uri($uri, $message = '')
	{
		Assert::assertSame((string) $uri, (string) $this->message->getUri(), $message);
		
		return $this;
	}

	public function getUri()
	{
		return new AssertUri($this->message->getUri());
	}
}