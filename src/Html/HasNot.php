<?php

namespace Psr7Unitesting\Html;

use Symfony\Component\DomCrawler\Crawler;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class HasNot extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has not any element matching with the selector "%s"', $this->expected);
    }

    protected function runMatches(Crawler $html)
    {
        return count($html->filter($this->expected)) === 0;
    }
}
