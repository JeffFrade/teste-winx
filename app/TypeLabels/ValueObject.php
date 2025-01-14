<?php

namespace App\TypeLabels;

/**
 * @codeCoverageIgnore
 */
abstract class ValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    function __construct($value)
    {
        $this->validateValue($value);
        $this->value = $value;
    }

    /**
     * Checks if $value is valid
     *
     * @param mixed $value
     * @throws \InvalidArgumentException if value validation fails
     */
    abstract protected function validateValue($value);

    /**
     * Returns the raw $value
     *
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Returns the string representation of $value
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }
}
