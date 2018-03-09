<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableCart;
use Converdo\ConversionMonitor\Core\Trackables\TrackableProduct;

class BaseCartFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableCart
     */
    protected $model;

    /**
     * The product instances.
     *
     * @var TrackableProduct[]
     */
    protected $products = [];

    /**
     * @inheritdoc
     *
     * @return TrackableCart
     */
    public function model()
    {
        return new TrackableCart();
    }
}