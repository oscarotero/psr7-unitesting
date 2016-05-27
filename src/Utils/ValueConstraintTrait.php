<?php

namespace Psr7Unitesting\Utils;

trait ValueConstraintTrait
{
    protected $expected;

    /**
     * @param string $expected
     */
    public function __construct($expected)
    {
        $this->expected = $expected;
        $this->exporter = new Exporter();
    }
}
