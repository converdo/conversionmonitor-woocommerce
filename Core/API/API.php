<?php

namespace Converdo\ConversionMonitor\Core\API;

use Converdo\ConversionMonitor\Core\API\Requests\OrderCreateRequest;
use Converdo\ConversionMonitor\Core\API\Requests\OrderUpdateRequest;
use Converdo\ConversionMonitor\Core\Trackables\TrackableOrder;

class API
{
    /**
     * Push a new order to the conversion monitor.
     *
     * @param  TrackableOrder       $order
     * @return string
     */
    public function order_create(TrackableOrder $order)
    {
        return $this->client()->send(new OrderCreateRequest($order));
    }

    /**
     * Push an order update to the conversion monitor.
     *
     * @param  TrackableOrder       $order
     * @return string
     */
    public function order_update(TrackableOrder $order)
    {
        return $this->client()->send(new OrderUpdateRequest($order));
    }

    /**
     * Get the api client instance.
     *
     * @return Client
     */
    protected function client()
    {
        return cvd_app(Client::class);
    }
}