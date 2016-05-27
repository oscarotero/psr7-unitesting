<?php

namespace Psr7Unitesting\Html;

use Symfony\Component\DomCrawler\Crawler;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class Contains extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has at least one element matching with the selector "%s" that contains "%s"', $this->key, $this->expected);
    }

    protected function runMatches(Crawler $html)
    {
        $texts = $html->filter($this->key)->each(function ($node) {
            return trim($node->text());
        });

        return array_filter($texts, function ($value) {
            return strpos($value, $this->expected) !== false;
        });
    }
}
