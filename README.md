# psr7-unitesting

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oscarotero/psr7-unitesting/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/oscarotero/psr7-unitesting/?branch=master)

Simple library to execute unit tests in [psr-7](http://www.php-fig.org/psr/psr-7/) compatible http messages.

It uses [symfony/dom-crawler](https://github.com/symfony/DomCrawler) and [symfony/css-selector](https://github.com/symfony/CssSelector) library to parse and test the html in the body. And [Guzzle](https://github.com/guzzle/guzzle) as http client

This package provides a binary java file with the w3c vnu validator (to validate html) but you can use the REST api (slower) if you don't have (or don't want to have) java installed.

## Usage example:

```php
use GuzzleHttp\Client;
use Psr7Unitesting\Assert;

class AppTest extends PHPUnit_Framework_TestCase
{
	public function testHomePage()
	{
		//Get the home page
		$client = new Client();
		$response = $client->get('http://example.com');

		//Test the response
		(new Assert\Response($response))
			->statusCode(200)
			->hasHeader('Cache-Control')
			->hasHeaderWithText('Content-Type', 'text/html')
			->hasNotHeader('Expires')

			->assertBody()
				->isReadable()
				->isSeekable()
				->end() //back to Assert\Response

			->assertHtml()
				->isValid() //use w3c vnu validator
				->hasElement('meta[property="og:title"]')
				->hasNotElement('blink')
				->hasElementWithText('a.home-link', 'Go to home')
				->hasNotElementWithText('p', '') //empty paragraphs
				->hasString('Hello world')
				->hasNotString('Lorem ipsum')

				//Execute more tests for each element individually
				->foreachElement('img', function ($img) {
					$this->assertNotEmpty($img->attr('alt'));
				});
	}
}
```
