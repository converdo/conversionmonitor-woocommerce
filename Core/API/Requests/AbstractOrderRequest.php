<?php

namespace Converdo\ConversionMonitor\Core\API\Requests;

use Converdo\ConversionMonitor\Core\Contracts\Requestable;
use Converdo\ConversionMonitor\Core\Trackables\TrackableOrder;

abstract class AbstractOrderRequest implements Requestable
{
    /**
     * The trackable order instance.
     *
     * @var TrackableOrder
     */
    protected $order;

    /**
     * OrderCreateRequest constructor.
     *
     * @param  TrackableOrder       $order
     */
    public function __construct(TrackableOrder $order)
    {
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function method()
    {
        return 'POST';
    }

    /**
     * @inheritdoc
     */
    public function payload()
    {
        return [
            'order' => $this->order->render(),
            'key' => cvd_config()->platform()->website(),
        ];
    }
}