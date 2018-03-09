<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackableCoupon;

class BaseCouponFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackableCoupon
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackableCoupon
     */
    public function model()
    {
        return new TrackableCoupon();
    }
}