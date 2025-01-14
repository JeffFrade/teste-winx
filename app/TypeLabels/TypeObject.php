<?php

namespace App\TypeLabels;

/**
 * @codeCoverageIgnore
 */
abstract class TypeObject extends ValueObject
{

    /**
     * @var array Constant => Laravel string key for a language file
     */
    protected static $typeLabels = [];

    /**
     * @param mixed $value
     * @return string Translated string (uses Laravel's trans() method)
     */
    public static function label($value)
    {
        return isset(static::$typeLabels[$value]) ? trans(static::$typeLabels[$value]) : '';
    }

    /**
     * Returns an array of all labels for all constants
     *
     * @return array
     */
    public static function labels()
    {
        $translatedLabels = array();

        foreach (static::$typeLabels as $key => $label) {
            $translatedLabels[$key] = trans($label);
        }

        return $translatedLabels;
    }

    /**
     * Returns an array of all accepted constant values
     *
     * @return array
     */
    public static function values()
    {
        return array_keys(static::$typeLabels);
    }

    /**
     * Checks if $value is defined by a constant
     *
     * @param mixed $value
     * @throws \InvalidArgumentException if value validation fails
     */
    protected function validateValue($value)
    {
        if (!in_array($value, $this->values())) {
            throw new \InvalidArgumentException("Invalid value [$value] for " . static::class);
        }
    }
}
