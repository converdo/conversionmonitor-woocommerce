<?php

namespace Converdo\ConversionMonitor\Core\Support;

class Container
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * Returns the Container instance.
     *
     * @return static
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * Loads a class or returns an existing.
     *
     * @param  string       $string
     * @return mixed
     */
    public static function make($string)
    {
        if (! isset(self::$instances[$string])) {
            self::$instances[$string] = new $string;
        }

        return self::$instances[$string];
    }
}