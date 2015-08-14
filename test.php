<?php
include 'vendor/autoload.php';

use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

use Psr7Unitesting\AssertResponse;

class AppTest extends PHPUnit_Framework_TestCase
{

	public function testOne()
	{
		$html = <<<EOT
<html>
	<head>
		<link rel="icon" href="ola.ico">
	</head>
	<body>
		<div>
		Ola mundo
		</div>
		<p class="mola">Ola</p>
		<p>Ola</p>
	</body>
</html>
EOT;
		$body = new Stream('php://temp', 'r+');
		$body->write($html);

		$response = (new Response())
			->withHeader('Content-Type', 'text/html')
			->withStatus(200)
			->withBody($body);


		(new AssertResponse($response))
			->statusCode(200)
			->hasHeader('Content-Type')
			->hasNotHeader('Accept')
			->header('Content-Type', 'text/html')
			->protocolVersion('1.1')
			->getHtmlBody()
				->isReadable()
				->isWritable()
				->isSeekable()
				->hasElement('p.mola')
				->hasElement('link[rel="icon"]')
				->countElements('p.mola', 1)
				->countElements('p', 2)
				->countElements('article', 0)
				->hasElementWithText('div', 'Ola mundo')
				;
	}
}
