<?php

namespace Psr7Unitesting\Html;

use Psr7Unitesting\Utils\AbstractConstraint as Constraint;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractConstraint extends Constraint
{
    protected function matches($html)
    {
        return $this->runMatches($html);
    }

    abstract protected function runMatches(Crawler $html);
}
