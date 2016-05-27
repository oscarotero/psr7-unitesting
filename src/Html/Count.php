<?php

namespace Psr7Unitesting\Html;

use Symfony\Component\DomCrawler\Crawler;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class Count extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has %d elements matching with the selector "%s"', $this->expected, $this->key);
    }

    protected function runMatches(Crawler $html)
    {
        return count($html->filter($this->key)) == $this->expected;
    }

    protected function additionalFailureDescription($html)
    {
        return sprintf('%d found', count($html->filter($this->key)));
    }
}
