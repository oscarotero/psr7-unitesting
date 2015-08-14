<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\ResponseInterface;

class AssertResponse extends AssertMessage
{
	public function statusCode($code, $message = '')
	{
		Assert::assertSame($code, $this->message->getStatusCode(), $message);
		
		return $this;
	}

	public function reasonPhrase($reasonPhrase, $message = '')
	{
		Assert::assertSame($reasonPhrase, $this->message->getReasonPhrase(), $message);
		
		return $this;
	}

	public function getHtmlBody()
	{
		return new AssertHtmlBody($this->message->getBody());
	}
}