<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableProduct;

class BaseProductFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableProduct
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableProduct
     */
    public function model()
    {
        return new TrackableProduct();
    }
}