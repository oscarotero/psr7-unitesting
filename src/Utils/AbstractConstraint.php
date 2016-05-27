<?php

namespace Psr7Unitesting\Utils;

use PHPUnit_Framework_Constraint as Constraint;

/**
 * Abstract class with common methods for all assertion classes.
 */
abstract class AbstractConstraint extends Constraint
{
    public function __construct()
    {
        $this->exporter = new Exporter();
    }
}
