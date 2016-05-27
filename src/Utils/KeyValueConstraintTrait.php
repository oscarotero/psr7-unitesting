<?php

namespace Psr7Unitesting\Utils;

trait KeyValueConstraintTrait
{
    protected $key;
    protected $expected;

    /**
     * @param string $key
     * @param string $expected
     */
    public function __construct($key, $expected)
    {
        $this->key = $key;
        $this->expected = $expected;
        $this->exporter = new Exporter();
    }
}
