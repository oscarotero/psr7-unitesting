<?php

namespace Psr7Unitesting\Html;

use Symfony\Component\DomCrawler\Crawler;
use Psr7Unitesting\Utils\KeyValueConstraintTrait;

class NotContains extends AbstractConstraint
{
    use KeyValueConstraintTrait;

    public function toString()
    {
        return sprintf('has not any element matching with the selector "%s" and containing "%s"', $this->key, $this->expected);
    }

    protected function runMatches(Crawler $html)
    {
        $texts = $html->filter($this->key)->each(function ($node) {
            return trim($node->text());
        });

        return count(array_filter($texts, function ($value) {
            return strpos($value, $this->expected) !== false;
        })) === 0;
    }
}
