<?php

namespace Converdo\ConversionMonitor\Core\API\Requests;

class OrderUpdateRequest extends AbstractOrderRequest
{
    /**
     * @inheritdoc
     */
    public function url()
    {
        return cvd_config()->url('order_update.php');
    }
}