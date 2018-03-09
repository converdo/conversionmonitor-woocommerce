<?php

namespace Converdo\ConversionMonitor\Core\Enumerables;

interface Type
{
    /**
     * Get the name of the type.
     *
     * @return string
     */
    public function name();
}