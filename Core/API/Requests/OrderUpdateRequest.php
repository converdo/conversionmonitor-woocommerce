<?php

namespace Converdo\ConversionMonitor\Core\API\Requests;

class OrderUpdateRequest extends AbstractOrderRequest
{
    /**
     * @inheritdoc
     */
    public function payload()
    {
        return array_merge(parent::payload(), [
            'type' => 'UPDATED',
        ]);
    }
}