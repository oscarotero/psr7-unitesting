<?php

namespace Psr7Unitesting\Html;

use Symfony\Component\DomCrawler\Crawler;
use Psr7Unitesting\Utils\ValueConstraintTrait;

class Has extends AbstractConstraint
{
    use ValueConstraintTrait;

    public function toString()
    {
        return sprintf('has at least one element matching with the selector "%s"', $this->expected);
    }

    protected function runMatches(Crawler $html)
    {
        return count($html->filter($this->expected)) > 0;
    }
}
