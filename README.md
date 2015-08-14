# psr7-unitesting

Simple library to execute unit tests in [psr-7](http://www.php-fig.org/psr/psr-7/) compatible http messages.

It uses [symfony/dom-crawler](https://github.com/symfony/DomCrawler) and [symfony/css-selector](https://github.com/symfony/CssSelector) library to parse and test the html in the body.

## Usage example:

```php
use Psr7Unitesting\AssertResponse;

class AppTest extends PHPUnit_Framework_TestCase
{
	public function testHomePage()
	{
		//create a response
		$app = new MyApp();
		$response = $app->dispatch('/');

		//Ok, it's time to unitesting!!
		(new AssertResponse($response))
			->statusCode(200)
			->hasHeader('Cache-Control')
			->hasHeaderWithText('Content-Type', 'text/html')
			->hasNotHeader('Expires')

			//returns an AssertHtmlBody to check the body content
			->getHtmlBody()
				->isReadable()
				->isSeekable()
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

Note: This is a work in progress project, any suggestion or pull request is welcome.
