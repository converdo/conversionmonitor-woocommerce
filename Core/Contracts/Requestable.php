<?php

namespace Converdo\ConversionMonitor\Core\Contracts;

interface Requestable
{
    /**
     * The url to the resource.
     *
     * @return string
     */
    public function url();

    /**
     * The request payload.
     *
     * @return array
     */
    public function payload();

    /**
     * The request method.
     *
     * @return string
     */
    public function method();
}