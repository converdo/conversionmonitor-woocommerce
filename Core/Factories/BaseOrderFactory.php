<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableOrder;

class BaseOrderFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableOrder
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableOrder
     */
    public function model()
    {
        return new TrackableOrder();
    }
}