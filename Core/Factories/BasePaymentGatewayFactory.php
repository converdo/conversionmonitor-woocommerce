<?php

namespace Converdo\ConversionMonitor\Core\Factories;

use Converdo\ConversionMonitor\Core\Trackables\TrackablePaymentGateway;

class BasePaymentGatewayFactory extends AbstractFactory
{
    /**
     * @inheritdoc
     *
     * @var TrackablePaymentGateway
     */
    protected $model;

    /**
     * @inheritdoc
     *
     * @return TrackablePaymentGateway
     */
    public function model()
    {
        return new TrackablePaymentGateway();
    }
}