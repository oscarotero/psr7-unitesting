# psr7-unitesting

Simple library for execute unit tests in psr-7 compatible http messages.

It uses symfony/dom-crawler and symfony/css-selector library to parse and test the html in the body.

## Usage example:

In the following example, I've used `Zend\Diactoros` but you can use any psr-7 compatible library:

```php
use Psr7Unitesting\AssertResponse;
use Zend\Diactoros\ServerRequest;

class AppTest extends PHPUnit_Framework_TestCase
{
	public function testHomePage()
	{
		//create a request and returns a response
		$app = new MyApp();
		$request = (new ServerRequest())->withTargetPath('/');
		$response = $app->dispatch($request);

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

Note: This is a work in progress project, any suggestion o collaboration is welcome.
