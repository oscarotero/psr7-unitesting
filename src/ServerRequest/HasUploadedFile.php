<?php

namespace Psr7Unitesting\ServerRequest;

use Psr\Http\Message\ServerRequestInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasUploadedFile extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the upload file "%s"', $this->expected);
    }

    protected function runMatches(ServerRequestInterface $request)
    {
        $files = $request->getUploadedFiles();

        return isset($files[$this->expected]);
    }
}
