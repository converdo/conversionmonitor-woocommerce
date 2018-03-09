<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Contracts\Buildable;
use Converdo\ConversionMonitor\Core\Contracts\Trackable;

abstract class AbstractFactory implements Buildable
{
    /**
     * The trackable instance.
     *
     * @var Trackable
     */
    protected $model;

    /**
     * @inheritdoc
     */
    abstract public function model();

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        // ...
    }

    /**
     * @inheritdoc
     */
    public function build()
    {
        // ...
    }

    /**
     * Call the factory and build the trackable instance.
     *
     * @return Trackable
     */
    public function call()
    {
        $this->model = $this->model();

        $this->prepare();

        $this->build();

        return $this->model;
    }
}