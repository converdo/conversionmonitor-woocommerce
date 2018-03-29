<?php

namespace Converdo\ConversionMonitor\Core\API\Requests;

class OrderCreateRequest extends AbstractOrderRequest
{
    /**
     * @inheritdoc
     */
    public function payload()
    {
        return array_merge(parent::payload(), [
            'type' => 'CREATED',
        ]);
    }
}