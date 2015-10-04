<?php

namespace Psr7Unitesting\Assert;

/**
 * Abstract class with common methods for all assertion classes.
 */
abstract class BaseAssert
{
    /**
     * @var BaseAssert
     */
    protected $previous;

    /**
     * Set the previous assertion object.
     * 
     * @param null|BaseAssert $previous
     * 
     * @return self
     */
    protected function previous(BaseAssert $previous = null)
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
}
