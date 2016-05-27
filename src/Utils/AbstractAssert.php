<?php

namespace Psr7Unitesting\Utils;

use PHPUnit_Framework_Assert as Assert;
use PHPUnit_Framework_Constraint as Constraint;

/**
 * Abstract class with common methods for all assertion classes.
 */
abstract class AbstractAssert
{
    /**
     * @var AbstractAssert
     */
    protected $previous;

    /**
     * Set the previous assertion object.
     * 
     * @param null|AbstractAssert $previous
     * 
     * @return self
     */
    protected function previous(AbstractAssert $previous = null)
    {
        $this->previous = $previous;

        return $this;
    }

    /**
     * Returns the previous assertion object.
     * 
     * @return null|Assert
     */
    public function end()
    {
        return $this->previous;
    }

    /**
     * Assert a value with a constraint.
     * 
     * @param mixed      $value
     * @param Constraint $constraint
     * @param string     $message
     * 
     * @return self
     */
    protected function assert($value, Constraint $constraint, $message = '')
    {
        Assert::assertThat($value, $constraint, $message);

        return $this;
    }
}
