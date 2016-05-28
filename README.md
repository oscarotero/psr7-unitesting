# psr7-unitesting

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oscarotero/psr7-unitesting/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/oscarotero/psr7-unitesting/?branch=master)
[![Build Status](https://travis-ci.org/oscarotero/psr7-unitesting.svg?branch=master)](https://travis-ci.org/oscarotero/psr7-unitesting)

Simple library to execute unit tests in [psr-7](http://www.php-fig.org/psr/psr-7/) compatible http messages.

It uses [symfony/dom-crawler](https://github.com/symfony/DomCrawler) and [symfony/css-selector](https://github.com/symfony/CssSelector) library to parse and test the html in the body. And [Guzzle](https://github.com/guzzle/guzzle) as http client

This package provides a binary java file with the w3c vnu validator (to validate html) but you can use the REST api (slower) if you don't have (or don't want to have) java installed.

## Usage example:

```php
use Psr7Unitesting\Assert;

class AppTest extends PHPUnit_Framework_TestCase
{
	public function testRemote()
	{
		//Execute a GET request and assert the response:

		Assert::get('http://example.com')
			->statusCode(200)
			->header('Content-Type', 'text/html')
			->hasHeader('Cache-Control')
			->hasNotHeader('Expires')

			->assertBody()
				->isReadable()
				->isSeekable()
				->end() //back to Response

			->assertHtml()
				->isValid() //use w3c vnu validator
				->has('meta[property="og:title"]')
				->hasNot('blink')
				->contains('a.home-link', 'Go to home')
				->notContains('p', '') //empty paragraphs

				//Execute more tests for each element individually
				->map('img', function ($img) {
					$this->assertNotEmpty($img->attr('alt'));
				});
	}

	public function testLocal()
	{
		//Assert local psr-7 instances
		$app = new App();
		$response = $app->dispatch('/post/34');

		Assert::create($response)
			->statusCode(200);
	}
}
```

## Available assertions:

### Message

method | description
------ | -----------
`hasHeader` | Asserts that a header exists
`hasNotHeader` | Asserts that a header does not exists
`header` | Asserts that a header has a specific value
`protocolVersion` | Asserts the protocol version of the message
`body` | Asserts the body content (as string)
`assertBody` | Returns a `Stream` assertion instance

### Request

Extends `Message` with the following additions:

method | description
------ | -----------
`method` | Asserts the method value
`requestTarget` | Asserts the request target value
`uri` | Asserts the uri value (as string)
`assertUri` | Returns a `Uri` assertion instance

### ServerRequest

Extends `Request` with the following additions:

method | description
------ | -----------
`hasServerParam` | Asserts that a server param exists
`serverParam` | Asserts a server param value
`hasCookieParam` | Asserts that a cookie param exists
`cookieParam` | Asserts a cookie param value
`hasQueryParam` | Asserts that a query param exists
`queryParam` | Asserts a query param value
`hasUploadedFile` | Asserts that an uploaded file exists
`hasParsedBody` | Asserts that a param exists in the parsed body
`parsedBody` | Asserts a value in the parsed body
`hasAttribute` | Asserts that an attribute exists
`attribute` | Asserts an attribute value

### Response

Extends `Message` with the following additions:

method | description
------ | -----------
`statusCode` | Asserts the status code value
`reasonPhrase` | Asserts the reason pharase value
`assertHtml` | Returns a `Html` assertion instance

### Uri

method | description
------ | -----------
`scheme` | Asserts the scheme value
`authority` | Asserts the authority value
`userInfo` | Asserts the user info value
`host` | Asserts the host value
`port` | Asserts the port value
`path` | Asserts the path value
`query` | Asserts the query value
`fragment` | Asserts the fragment value

### Stream

method | description
------ | -----------
`size` | Asserts the stream size
`isSeekable` | Asserts that the stream is seekable
`isNotSeekable` | Asserts that the stream is not seekable
`isWritable` | Asserts that the stream is writable
`isNotWritable` | Asserts that the stream is not writable
`isReadable` | Asserts that the stream is readable
`isNotReadable` | Asserts that the stream is not readable
`assertHtml` | Returns a `Html` assertion instance

### Html

method | description
------ | -----------
`count` | Asserts the number of elements matching with the selector
`has` | Asserts there is at least one element matching with the selector
`hasNot` | Asserts there is not any element matching with the selector
`contains` | Asserts there is at least one element matching with the selector containing the text
`notContains` | Asserts there is not any element matching with the selector and containing the text
`isValid` | Asserts the html value is w3c standard
`map` | Execute a callback for each element selected


