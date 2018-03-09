<?php

namespace Converdo\ConversionMonitor\Core\API\Requests;

class OrderCreateRequest extends AbstractOrderRequest
{
    /**
     * @inheritdoc
     */
    public function url()
    {
        return cvd_config()->url('order_create.php');
    }
}