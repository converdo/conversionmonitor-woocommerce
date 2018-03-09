<?php

namespace Converdo\ConversionMonitor\Core\Contracts;

interface Buildable
{
    /**
     * Get the trackable instance.
     *
     * @return Trackable
     */
    public function model();

    /**
     * Build the trackable instance.
     *
     * @return Trackable
     */
    public function build();

    /**
     * Build the trackable instance with default values.
     *
     * @return Trackable
     */
    public function prepare();

    /**
     * Call the factory and build the trackable instance.
     *
     * @return Trackable
     */
    public function call();
}