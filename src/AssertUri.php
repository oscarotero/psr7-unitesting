<?php
namespace Psr7Unitesting;

use PHPUnit_Framework_Assert as Assert;
use Psr\Http\Message\UriInterface;

class AssertUri
{
	protected $uri;

	public function __construct(UriInterface $uri)
	{
		$this->uri = $uri;
	}
}