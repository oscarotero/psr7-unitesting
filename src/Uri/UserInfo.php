<?php

namespace Psr7Unitesting\Uri;

use Psr\Http\Message\UriInterface;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class UserInfo extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has the user info "%s"', $this->expected);
    }

    protected function runMatches(UriInterface $uri)
    {
        return $uri->getUserInfo() == $this->expected;
    }

    protected function additionalFailureDescription($uri)
    {
        return sprintf('"%s" returned', $uri->getUserInfo());
    }
}
